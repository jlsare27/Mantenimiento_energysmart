<?php

namespace App\Http\Controllers;

use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HogarController extends Controller
{
    // Muestra la lista de hogares registrados para el usuario autenticado
    public function index()
    {
        $homes = Home::where('user_id', Auth::id())->get();
        return view('hogar.index', compact('homes'));
    }

    // Muestra el formulario para ingresar la información del hogar
    public function create()
    {
        return view('hogar.create');
    }

    // Almacena la información del hogar, incluyendo electrodomésticos y datos de iluminación
    public function store(Request $request)
    {
        // Validación de la información global del hogar
        $validated = $request->validate([
            'location'                => 'required|string',
            'general_characteristics' => 'nullable|string',
            'connection_type'         => 'required|string',
        ]);

        // Guarda la información global del hogar asociándolo al usuario autenticado
        $home = Home::create([
            'user_id'                => Auth::id(),
            'location'               => $validated['location'],
            'general_characteristics'=> $validated['general_characteristics'] ?? null,
            'connection_type'        => $validated['connection_type'],
        ]);

        // Procesa el array de electrodomésticos si se envía
        if ($request->has('appliances')) {
            foreach ($request->input('appliances') as $applianceData) {
                // Validar cada electrodoméstico
                $applianceValidated = validator($applianceData, [
                    'name'                     => 'required|string',
                    'brand'                    => 'nullable|string',
                    'model'                    => 'nullable|string',
                    'category'                 => 'nullable|string',
                    'nominal_power'            => 'required|integer',
                    'daily_usage_hours'        => 'required|numeric',
                    'energy_efficiency_label'  => 'nullable|string',
                    'acquisition_year'         => 'nullable|digits:4|integer',
                ])->validate();
                $home->appliances()->create($applianceValidated);
            }
        }

        // Procesa el array de datos de iluminación si se envía
        if ($request->has('lightings')) {
            foreach ($request->input('lightings') as $lightingData) {
                $lightingValidated = validator($lightingData, [
                    'bulb_type' => 'required|string',
                    'power'     => 'required|integer',
                    'quantity'  => 'required|integer',
                ])->validate();
                $home->lightings()->create($lightingValidated);
            }
        }

        return redirect()->route('hogares.index')->with('success', 'Información del hogar guardada.');
    }

    // Muestra los detalles de un hogar, incluyendo relaciones (electrodomésticos, iluminación, consumo y recomendaciones)
    public function show($id)
    {
        $home = Home::with(['appliances', 'lightings', 'consumptionHistories', 'recommendations'])->findOrFail($id);
        return view('hogar.show', compact('home'));
    }
}
