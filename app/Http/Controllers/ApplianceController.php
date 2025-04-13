<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Appliance;
use App\Http\Requests\StoreApplianceRequest;
use App\Http\Requests\UpdateApplianceRequest;

class ApplianceController extends Controller
{
    public function index(Home $home)
    {
        $this->authorize('view', $home);
        $appliances = $home->appliances()->latest()->get();
        return view('appliances.index', compact('home', 'appliances'));
    }

    public function create(Home $home)
    {
        $this->authorize('update', $home);
        return view('appliances.create', compact('home'));
    }

    public function store(StoreApplianceRequest $request, Home $home)
    {
        $this->authorize('update', $home);
        $home->appliances()->create($request->validated());
        return redirect()->route('homes.appliances.index', $home)->with('success', 'Electrodoméstico añadido exitosamente');
    }

    public function show(Home $home, Appliance $appliance)
    {
        $this->authorize('view', $home);
        return view('appliances.show', compact('home', 'appliance'));
    }

    public function edit(Home $home, Appliance $appliance)
    {
        $this->authorize('update', $home);
        return view('appliances.edit', compact('home', 'appliance'));
    }

    public function update(UpdateApplianceRequest $request, Home $home, Appliance $appliance)
    {
        $this->authorize('update', $home);
        $appliance->update($request->validated());
        return redirect()->route('homes.appliances.show', [$home, $appliance])->with('success', 'Electrodoméstico actualizado exitosamente');
    }

    public function destroy(Home $home, Appliance $appliance)
    {
        $this->authorize('update', $home);
        $appliance->delete();
        return redirect()->route('homes.appliances.index', $home)->with('success', 'Electrodoméstico eliminado exitosamente');
    }
}