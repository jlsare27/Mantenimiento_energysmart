@extends('layouts.app')

@section('title', 'Metas de Ahorro - ' . $home->name)

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Metas de Ahorro - {{ $home->name }}</h5>
        <a href="{{ route('homes.goals.create', $home) }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Nueva Meta
        </a>
    </div>
    <div class="card-body">
        @if($goals->isEmpty())
            <div class="alert alert-info">No hay metas de ahorro definidas para este hogar.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Meta</th>
                            <th>Fecha Objetivo</th>
                            <th>Progreso</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($goals as $goal)
                            <tr>
                                <td>{{ $goal->name }}</td>
                                <td>{{ number_format($goal->target_consumption, 2) }} kWh</td>
                                <td>{{ $goal->target_date->format('M Y') }}</td>
                                <td>
                                    @if($goal->current_consumption)
                                        @php
                                            $percentage = min(100, ($goal->current_consumption / $goal->target_consumption) * 100);
                                        @endphp
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-{{ $percentage <= 100 ? 'success' : 'danger' }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $percentage }}%" 
                                                 aria-valuenow="{{ $percentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ number_format($percentage, 1) }}%
                                            </div>
                                        </div>
                                        <small class="text-muted">
                                            {{ number_format($goal->current_consumption, 2) }} kWh / {{ number_format($goal->target_consumption, 2) }} kWh
                                        </small>
                                    @else
                                        <span class="text-muted">Sin datos actuales</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $goal->status == 'achieved' ? 'success' : ($goal->status == 'failed' ? 'danger' : 'primary') }}">
                                        {{ ucfirst($goal->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('homes.goals.show', [$home, $goal]) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('homes.goals.edit', [$home, $goal]) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $goals->links() }}
            </div>
        @endif
    </div>
    <div class="card-footer bg-transparent">
        <a href="{{ route('homes.show', $home) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver al hogar
        </a>
    </div>
</div>
@endsection