<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Services\ConsumptionCalculator;

class ConsumptionController extends Controller
{
    public function analyze(Home $home)
    {
        $this->authorize('view', $home);
        
        $calculator = new ConsumptionCalculator($home);
        $analysis = $calculator->analyze();
        
        return view('consumption.analysis', compact('home', 'analysis'));
    }

    public function history(Home $home)
    {
        $this->authorize('view', $home);
        $consumptions = $home->energyConsumptions()->latest()->paginate(12);
        return view('consumption.history', compact('home', 'consumptions'));
    }

    public function storeAnalysis(Home $home)
    {
        $this->authorize('update', $home);
        
        $calculator = new ConsumptionCalculator($home);
        $consumption = $calculator->saveCurrentConsumption();
        
        return redirect()->route('homes.consumption.history', $home)
            ->with('success', 'Análisis de consumo guardado exitosamente');
    }
}