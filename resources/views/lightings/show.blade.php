@extends('layouts.app')

@section('title', 'Sistema de Iluminación')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sistema de Iluminación - {{ ucfirst($lighting->type) }}</h5>
        <div>
            <a href="{{ route('homes.lightings.edit', [$home, $lighting]) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Tipo:</strong> {{ ucfirst($lighting->type) }}</p>
                <p><strong>Potencia por unidad:</strong> {{ $lighting->power }} W</p>
                <p><strong>Cantidad:</strong> {{ $lighting->quantity }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Horas de uso diario:</strong> {{ $lighting->hours_use }} horas</p>
                @if($lighting->location)
                    <p><strong>Ubicación:</strong> {{ $lighting->location }}</p>
                @endif
            </div>
        </div>
        
        <div class="mt-4">
            <h6>Consumo Energético</h6>
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3 class="mb-0">{{ number_format($lighting->daily_consumption, 2) }}</h3>
                            <small class="text-muted">kWh/día</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3 class="mb-0">{{ number_format($lighting->daily_consumption * 30, 2) }}</h3>
                            <small class="text-muted">kWh/mes</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h3 class="mb-0">${{ number_format($lighting->daily_consumption * 30 * $home->energy_tariff, 2) }}</h3>
                            <small class="text-muted">Costo mensual estimado</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @if($lighting->type === 'incandescente' || $lighting->type === 'halogena')
            <div class="alert alert-warning mt-4">
                <i class="bi bi-exclamation-triangle"></i> Este tipo de iluminación es menos eficiente energéticamente. 
                Considera reemplazarla por LED para ahorrar hasta un 80% en consumo.
            </div>
        @endif
    </div>
    <div class="card-footer bg-transparent">
        <a href="{{ route('homes.lightings.index', $home) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection