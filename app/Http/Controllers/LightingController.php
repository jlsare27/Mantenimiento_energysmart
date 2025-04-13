<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Lighting;
use App\Http\Requests\StoreLightingRequest;
use App\Http\Requests\UpdateLightingRequest;

class LightingController extends Controller
{
    public function index(Home $home)
    {
        $this->authorize('view', $home);
        $lightings = $home->lightings()->latest()->get();
        return view('lightings.index', compact('home', 'lightings'));
    }

    public function create(Home $home)
    {
        $this->authorize('update', $home);
        return view('lightings.create', compact('home'));
    }

    public function store(StoreLightingRequest $request, Home $home)
    {
        $this->authorize('update', $home);
        $home->lightings()->create($request->validated());
        return redirect()->route('homes.lightings.index', $home)->with('success', 'Sistema de iluminación añadido exitosamente');
    }

    public function show(Home $home, Lighting $lighting)
    {
        $this->authorize('view', $home);
        return view('lightings.show', compact('home', 'lighting'));
    }

    public function edit(Home $home, Lighting $lighting)
    {
        $this->authorize('update', $home);
        return view('lightings.edit', compact('home', 'lighting'));
    }

    public function update(UpdateLightingRequest $request, Home $home, Lighting $lighting)
    {
        $this->authorize('update', $home);
        $lighting->update($request->validated());
        return redirect()->route('homes.lightings.show', [$home, $lighting])->with('success', 'Sistema de iluminación actualizado exitosamente');
    }

    public function destroy(Home $home, Lighting $lighting)
    {
        $this->authorize('update', $home);
        $lighting->delete();
        return redirect()->route('homes.lightings.index', $home)->with('success', 'Sistema de iluminación eliminado exitosamente');
    }
}