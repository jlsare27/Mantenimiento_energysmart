<?php

namespace App\Services;

use App\Models\Home;
use App\Models\Recommendation;

class RecommendationService
{
    public function generateForHome(Home $home)
    {
        // Limpiar recomendaciones no implementadas existentes
        $home->recommendations()->where('implemented', false)->delete();
        
        $recommendations = [];
        
        // 1. Analizar iluminación
        $this->analyzeLighting($home, $recommendations);
        
        // 2. Analizar electrodomésticos
        $this->analyzeAppliances($home, $recommendations);
        
        // 3. Analizar tarifa
        $this->analyzeTariff($home, $recommendations);
        
        // Guardar todas las recomendaciones
        $home->recommendations()->createMany($recommendations);
    }
    
    protected function analyzeLighting(Home $home, &$recommendations)
    {
        $inefficientLighting = $home->lightings()
            ->whereIn('type', ['incandescente', 'halogena'])
            ->get();
            
        if ($inefficientLighting->count() > 0) {
            $totalPower = $inefficientLighting->sum(function($light) {
                return $light->power * $light->quantity;
            });
            
            $potentialSavings = $totalPower * $inefficientLighting->avg('hours_use') * 0.3 * 30 / 1000; // 30% ahorro estimado
            
            $recommendations[] = [
                'type' => 'lighting',
                'description' => "Reemplaza {$inefficientLighting->count()} sistemas de iluminación ineficientes (incandescentes/halógenas) por LED para ahorrar aproximadamente " . round($potentialSavings, 2) . " kWh/mes",
                'priority' => 'high',
                'potential_savings' => $potentialSavings,
            ];
        }
    }
    
    protected function analyzeAppliances(Home $home, &$recommendations)
    {
        // Electrodomésticos antiguos
        $oldAppliances = $home->appliances()
            ->where('year_acquired', '<', now()->subYears(10)->year)
            ->get();
            
        foreach ($oldAppliances as $appliance) {
            $potentialSavings = $appliance->daily_consumption * 0.2 * 30; // 20% ahorro estimado
            
            $recommendations[] = [
                'type' => 'appliance',
                'description' => "Considera reemplazar el {$appliance->name} (modelo antiguo de {$appliance->year_acquired}) por un modelo más eficiente para ahorrar aproximadamente " . round($potentialSavings, 2) . " kWh/mes",
                'priority' => 'medium',
                'potential_savings' => $potentialSavings,
            ];
        }
        
        // Electrodomésticos con alto consumo
        $highConsumers = $home->appliances()
            ->orderByRaw('(power * hours_use * quantity) DESC')
            ->take(2)
            ->get();
            
        foreach ($highConsumers as $appliance) {
            $recommendations[] = [
                'type' => 'behavior',
                'description' => "Reduce el uso del {$appliance->name} ({$appliance->power}W) en 1 hora diaria para ahorrar aproximadamente " . round($appliance->power * 1 * 30 / 1000, 2) . " kWh/mes",
                'priority' => 'medium',
                'potential_savings' => $appliance->power * 1 * 30 / 1000,
            ];
        }
    }
    
    protected function analyzeTariff(Home $home, &$recommendations)
    {
        // Aquí podrías integrar con una API de tarifas para comparar
        // Por ahora solo un ejemplo básico
        if ($home->energy_tariff > 0.9) { // Si la tarifa es mayor a $0.9 por kWh
            $recommendations[] = [
                'type' => 'tariff',
                'description' => "Tu tarifa de energía parece alta. Considera consultar con tu proveedor sobre planes más económicos o alternativas disponibles en tu área.",
                'priority' => 'low',
            ];
        }
    }
}