<?php

namespace App\Services;

use App\Models\Home;
use App\Models\EnergyConsumption;

class ConsumptionCalculator
{
    protected $home;
    
    public function __construct(Home $home)
    {
        $this->home = $home;
    }
    
    public function analyze()
    {
        $appliancesConsumption = $this->home->appliances->sum('daily_consumption');
        $lightingConsumption = $this->home->lightings->sum('daily_consumption');
        $totalDailyConsumption = $appliancesConsumption + $lightingConsumption;
        $estimatedMonthlyConsumption = $totalDailyConsumption * 30;
        
        $estimatedCost = $estimatedMonthlyConsumption * $this->home->energy_tariff;
        
        $topConsumers = $this->home->appliances()
            ->orderByRaw('(power * hours_use * quantity) DESC')
            ->take(3)
            ->get();
        
        return [
            'daily_consumption' => $totalDailyConsumption,
            'monthly_consumption' => $estimatedMonthlyConsumption,
            'estimated_cost' => $estimatedCost,
            'appliances_consumption' => $appliancesConsumption,
            'lighting_consumption' => $lightingConsumption,
            'top_consumers' => $topConsumers,
            'tariff' => $this->home->energy_tariff,
        ];
    }
    
    public function saveCurrentConsumption()
    {
        $analysis = $this->analyze();
        
        return EnergyConsumption::create([
            'home_id' => $this->home->id,
            'period_date' => now(),
            'total_consumption' => $analysis['monthly_consumption'],
            'estimated_cost' => $analysis['estimated_cost'],
            'breakdown' => [
                'appliances' => $analysis['appliances_consumption'],
                'lighting' => $analysis['lighting_consumption'],
                'top_consumers' => $analysis['top_consumers']->pluck('name')->toArray(),
            ],
        ]);
    }
}