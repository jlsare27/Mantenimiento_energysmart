@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Bienvenido a EnergySmart</h5>
            </div>
            <div class="card-body">
                <p>EnergySmart te ayuda a monitorear y optimizar el consumo de energía eléctrica en tus hogares.</p>
                
                @if($homes->isEmpty())
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> No tienes hogares registrados. 
                        <a href="{{ route('homes.create') }}" class="alert-link">Comienza agregando uno</a>.
                    </div>
                @else
                    <div class="alert alert-success">
                        <i class="bi bi-house-check"></i> Tienes {{ $homes->count() }} {{ Str::plural('hogar', $homes->count()) }} registrado{{ $homes->count() > 1 ? 's' : '' }}.
                        <a href="{{ route('homes.index') }}" class="alert-link">Ver todos</a> o 
                        <a href="{{ route('homes.create') }}" class="alert-link">agregar otro</a>.
                    </div>
                    
                    <h6 class="mt-4">Resumen de Consumo</h6>
                    <div class="row g-4">
                        @foreach($homes as $home)
                            @php
                                $latestConsumption = $home->energyConsumptions->first();
                            @endphp
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $home->name }}</h5>
                                        @if($latestConsumption)
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-muted">Último registro:</span>
                                                <span>{{ $latestConsumption->period_date->format('M Y') }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-muted">Consumo:</span>
                                                <span>{{ number_format($latestConsumption->total_consumption, 2) }} kWh</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-2">
                                                <span class="text-muted">Costo estimado:</span>
                                                <span>${{ number_format($latestConsumption->estimated_cost, 2) }}</span>
                                            </div>
                                        @else
                                            <div class="alert alert-warning py-2 my-2">
                                                <small><i class="bi bi-exclamation-triangle"></i> No hay datos de consumo registrados</small>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <a href="{{ route('homes.show', $home) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Metas Activas</h5>
                @if(!$homes->isEmpty())
                    <a href="{{ route('homes.goals.create', $homes->first()) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle"></i> Nueva
                    </a>
                @endif
            </div>
            <div class="card-body">
                @php
                    $activeGoals = collect();
                    foreach ($homes as $home) {
                        $activeGoals = $activeGoals->merge($home->goals->where('status', 'active'));
                    }
                @endphp
                
                @if($activeGoals->isEmpty())
                    <div class="alert alert-info">No tienes metas activas.</div>
                @else
                    <div class="list-group">
                        @foreach($activeGoals->take(3) as $goal)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $goal->name }}</h6>
                                        <small class="text-muted">{{ $goal->home->name }} - Meta: {{ number_format($goal->target_consumption, 2) }} kWh para {{ $goal->target_date->format('M Y') }}</small>
                                    </div>
                                    <span class="badge bg-primary">Activa</span>
                                </div>
                                @if($goal->current_consumption)
                                    @php
                                        $percentage = min(100, ($goal->current_consumption / $goal->target_consumption) * 100);
                                    @endphp
                                    <div class="progress mt-2" style="height: 8px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block">
                                        {{ number_format($percentage, 1) }}% completado ({{ number_format($goal->current_consumption, 2) }} kWh)
                                    </small>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    @if($activeGoals->count() > 3)
                        <div class="mt-3 text-center">
                            <a href="{{ route('homes.goals.index', $activeGoals->first()->home) }}" class="btn btn-sm btn-outline-primary">
                                Ver todas las metas
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Recomendaciones Recientes</h5>
            </div>
            <div class="card-body">
                @php
                    $recentRecommendations = collect();
                    foreach ($homes as $home) {
                        $recentRecommendations = $recentRecommendations->merge($home->recommendations->where('implemented', false)->sortByDesc('created_at'));
                    }
                @endphp
                
                @if($recentRecommendations->isEmpty())
                    <div class="alert alert-info">No hay recomendaciones pendientes.</div>
                @else
                    <div class="list-group">
                        @foreach($recentRecommendations->take(3) as $recommendation)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <span class="badge bg-{{ $recommendation->priority == 'high' ? 'danger' : ($recommendation->priority == 'medium' ? 'warning' : 'secondary') }} me-2">
                                        {{ ucfirst($recommendation->priority) }}
                                    </span>
                                    <small class="text-muted">{{ $recommendation->home->name }}</small>
                                </div>
                                <p class="mb-1 mt-2">{{ Str::limit($recommendation->description, 80) }}</p>
                                @if($recommendation->potential_savings)
                                    <small class="text-success">
                                        <i class="bi bi-lightning-charge"></i> Ahorro potencial: {{ number_format($recommendation->potential_savings, 2) }} kWh/mes
                                    </small>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    @if($recentRecommendations->count() > 3)
                        <div class="mt-3 text-center">
                            <a href="{{ route('homes.show', $recentRecommendations->first()->home) }}" class="btn btn-sm btn-outline-primary">
                                Ver todas las recomendaciones
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection