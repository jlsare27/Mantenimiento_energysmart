@extends('layouts.app')

@section('title', $goal->name)

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $goal->name }}</h5>
        <div>
            <a href="{{ route('homes.goals.edit', [$home, $goal]) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Meta de consumo:</strong> {{ number_format($goal->target_consumption, 2) }} kWh/mes</p>
                <p><strong>Fecha objetivo:</strong> {{ $goal->target_date->format('F Y') }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge bg-{{ $goal->status == 'achieved' ? 'success' : ($goal->status == 'failed' ? 'danger' : 'primary') }}">
                        {{ ucfirst($goal->status) }}
                    </span>
                </p>
            </div>
            <div class="col-md-6">
                @if($goal->current_consumption)
                    <p><strong>Consumo actual:</strong> {{ number_format($goal->current_consumption, 2) }} kWh/mes</p>
                    @php
                        $percentage = min(100, ($goal->current_consumption / $goal->target_consumption) * 100);
                        $remaining = max(0, $goal->target_consumption - $goal->current_consumption);
                    @endphp
                    <p><strong>Progreso:</strong> {{ number_format($percentage, 1) }}%</p>
                    <p><strong>Restante:</strong> {{ number_format($remaining, 2) }} kWh</p>
                @else
                    <div class="alert alert-info">No hay datos de consumo actual para esta meta.</div>
                @endif
            </div>
        </div>
        
        @if($goal->current_consumption)
            <div class="mb-4">
                <h6>Progreso hacia la meta</h6>
                <div class="progress" style="height: 30px;">
                    <div class="progress-bar bg-{{ $percentage <= 100 ? 'success' : 'danger' }}" 
                         role="progressbar" 
                         style="width: {{ $percentage }}%" 
                         aria-valuenow="{{ $percentage }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ number_format($percentage, 1) }}%
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <small>0 kWh</small>
                    <small>{{ number_format($goal->target_consumption, 2) }} kWh</small>
                </div>
            </div>
        @endif
        
        @if($goal->notes)
            <div class="mb-4">
                <h6>Notas</h6>
                <div class="card bg-light">
                    <div class="card-body">
                        {{ $goal->notes }}
                    </div>
                </div>
            </div>
        @endif
        
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i> 
            @if($goal->status == 'active')
                Esta meta está activa y se espera alcanzarla para {{ $goal->target_date->format('F Y') }}.
            @elseif($goal->status == 'achieved')
                ¡Felicidades! Has alcanzado esta meta.
            @else
                Esta meta no fue alcanzada en el período establecido.
            @endif
        </div>
    </div>
    <div class="card-footer bg-transparent">
        <a href="{{ route('homes.goals.index', $home) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection