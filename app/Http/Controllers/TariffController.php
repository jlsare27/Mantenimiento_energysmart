<?php

namespace App\Http\Controllers;

use App\Models\Tariff;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    // Lista todas las tarifas disponibles
    public function index()
    {
        $tariffs = Tariff::all();
        return view('tariffs.index', compact('tariffs'));
    }

    // Muestra la información de una tarifa específica
    public function show($id)
    {
        $tariff = Tariff::findOrFail($id);
        return view('tariffs.show', compact('tariff'));
    }

    // Actualiza la tarifa de forma manual
    public function update(Request $request, $id)
    {
        $tariff = Tariff::findOrFail($id);
        $validated = $request->validate([
            'region'        => 'required|string',
            'price_per_kwh' => 'required|numeric',
        ]);
        $tariff->update($validated);
        return redirect()->route('tariffs.show', $id)->with('success', 'Tarifa actualizada.');
    }

    // Actualiza o crea una tarifa utilizando datos obtenidos de una API externa y geolocalización
    public function updateFromAPI(Request $request)
    {
        // Se usa la ubicación del usuario o región para obtener la tarifa de un servicio externo
        $region = $request->input('region');
        // Aquí se integraría la lógica de consulta a la API externa. Para efectos de ejemplo, se asigna un valor ficticio.
        $price = 0.15; // Valor obtenido (ficticio)
        $tariff = Tariff::updateOrCreate(
            ['region' => $region],
            ['price_per_kwh' => $price]
        );
        return response()->json(['message' => 'Tarifa actualizada desde API', 'tariff' => $tariff]);
    }
}
