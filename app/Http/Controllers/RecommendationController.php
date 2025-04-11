<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    // Genera recomendaciones para un hogar basándose en el consumo total
    public function generateRecommendations($homeId)
    {
        $home = Home::with(['consumptionHistories', 'appliances', 'lightings', 'tariff'])->findOrFail($homeId);
        // Ejemplo de lógica: sumar el consumo total y comparar con un umbral definido
        $totalConsumption = $home->consumptionHistories()->sum('consumption_kwh');
        $recommendationText = '';

        if ($totalConsumption > 100) {
            $recommendationText = "Tu consumo es alto. Considera optimizar el uso de electrodomésticos e iluminación y evalúa cambiar a dispositivos de mayor eficiencia.";
        } else {
            $recommendationText = "Tu consumo está en un rango adecuado. Sigue manteniendo buenos hábitos y monitoreando el uso de energía.";
        }

        $home->recommendations()->create([
            'title'       => 'Análisis de consumo energético',
            'description' => $recommendationText,
        ]);

        return redirect()->route('hogares.show', $homeId)->with('success', 'Recomendaciones generadas.');
    }

    // Muestra las recomendaciones registradas para un hogar
    public function index($homeId)
    {
        $home = Home::with('recommendations')->findOrFail($homeId);
        return view('recommendations.index', compact('home'));
    }
}
