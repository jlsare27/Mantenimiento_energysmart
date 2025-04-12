<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;

class HomeController extends Controller
{
    public function index()
    {
        $homes = auth()->user()->homes()->withCount(['appliances', 'lightings'])->get();
        return view('homes.index', compact('homes'));
    }

    public function create()
    {
        return view('homes.create');
    }

    public function store(StoreHomeRequest $request)
    {
        $home = auth()->user()->homes()->create($request->validated());
        return redirect()->route('homes.show', $home)->with('success', 'Hogar creado exitosamente');
    }

    public function show(Home $home)
    {
        $this->authorize('view', $home);
        
        $home->load(['appliances', 'lightings', 'energyConsumptions' => function($query) {
            $query->latest()->limit(6);
        }, 'recommendations' => function($query) {
            $query->where('implemented', false)->latest();
        }]);
        
        return view('homes.show', compact('home'));
    }

    public function edit(Home $home)
    {
        $this->authorize('update', $home);
        return view('homes.edit', compact('home'));
    }

    public function update(UpdateHomeRequest $request, Home $home)
    {
        $this->authorize('update', $home);
        $home->update($request->validated());
        return redirect()->route('homes.show', $home)->with('success', 'Hogar actualizado exitosamente');
    }

    public function destroy(Home $home)
    {
        $this->authorize('delete', $home);
        $home->delete();
        return redirect()->route('homes.index')->with('success', 'Hogar eliminado exitosamente');
    }
}