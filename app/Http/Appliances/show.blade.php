@extends('layouts.app')

@section('title', $appliance->name)

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $appliance->name }}</h5>
        <div>
            <a href="{{ route('homes.appliances.edit', [$home, $appliance]) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Categoría:</strong> {{ ucfirst($appliance->category) }}</p>
                <p><strong>Potencia:</strong> {{ $appliance->power }} W</p>
                <p><strong>Uso diario:</strong> {{ $appliance->hours_use }} horas</p>
                <p><strong>Cantidad:</strong> {{ $appliance->quantity }}</p>
            </div>
            <div class="col-md-6">
                @if($appliance->brand)
                    <p><strong>Marca:</strong> {{ $appliance->brand }}</p>
                @endif
                @if($appliance->model)
                    <p><strong>Modelo:</strong> {{ $appliance->model }}</p>
                @endif
                @if($appliance->energy_efficiency)
                    <p><strong>Eficiencia energética:</strong> {{ $appliance->energy_efficiency }}</p>
                @endif
                @if($appliance->year_acquired)
                    <p><strong>Año de adquisición:</strong> {{ $appliance->year_acquired }}</p>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            <h6>Consumo Energético</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3 class="mb-0">{{ number_format($appliance->daily_consumption, 2) }}</h3>
                            <small class="text-muted">kWh/día</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3 class="mb-0">{{ number_format($appliance->daily_consumption * 30, 2) }}</h3>
                            <small class="text-muted">kWh/mes</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3 class="mb-0">${{ number_format($appliance->daily_consumption * 30 * $home->energy_tariff, 2) }}</h3>
                            <small class="text-muted">Costo mensual estimado</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if($appliance->notes)
            <div class="mt-4">
                <h6>Notas Adicionales</h6>
                <div class="card bg-light">
                    <div class="card-body">
                        {{ $appliance->notes }}
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="card-footer bg-transparent">
        <a href="{{ route('homes.appliances.index', $home) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection