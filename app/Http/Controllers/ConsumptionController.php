<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\ConsumptionHistory;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    // Almacena un registro del consumo energético para un hogar en específico
    public function store(Request $request, $homeId)
    {
        $validated = $request->validate([
            'consumption_kwh' => 'required|numeric',
            'consumption_date'=> 'required|date',
        ]);

        $home = Home::findOrFail($homeId);
        $home->consumptionHistories()->create($validated);

        return redirect()->route('hogares.show', $homeId)->with('success', 'Consumo registrado.');
    }

    // Muestra el historial de consumo del hogar
    public function show($homeId)
    {
        $home = Home::with('consumptionHistories')->findOrFail($homeId);
        return view('consumption.show', compact('home'));
    }
}
