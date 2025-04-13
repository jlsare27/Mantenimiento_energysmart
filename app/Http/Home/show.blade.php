@extends('layouts.app')

@section('title', $home->name)

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $home->name }}</h5>
                <div>
                    <a href="{{ route('homes.edit', $home) }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><i class="bi bi-geo-alt"></i> <strong>Dirección:</strong> {{ $home->address }}, {{ $home->city }}, {{ $home->state }}</p>
                        <p><i class="bi bi-people"></i> <strong>Ocupantes:</strong> {{ $home->occupants }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><i class="bi bi-lightning-charge"></i> <strong>Tipo de conexión:</strong> {{ ucfirst($home->connection_type) }}</p>
                        <p><i class="bi bi-rulers"></i> <strong>Área:</strong> {{ $home->area }} m²</p>
                    </div>
                </div>
                
                <ul class="nav nav-tabs" id="homeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="consumption-tab" data-bs-toggle="tab" data-bs-target="#consumption" type="button">
                            <i class="bi bi-graph-up"></i> Consumo
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="appliances-tab" data-bs-toggle="tab" data-bs-target="#appliances" type="button">
                            <i class="bi bi-plug"></i> Electrodomésticos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="lighting-tab" data-bs-toggle="tab" data-bs-target="#lighting" type="button">
                            <i class="bi bi-lightbulb"></i> Iluminación
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="recommendations-tab" data-bs-toggle="tab" data-bs-target="#recommendations" type="button">
                            <i class="bi bi-lightbulb"></i> Recomendaciones
                        </button>
                    </li>
                </ul>
                
                <div class="tab-content p-3 border border-top-0 rounded-bottom" id="homeTabsContent">
                    <div class="tab-pane fade show active" id="consumption" role="tabpanel">
                        @include('consumption.analysis')
                    </div>
                    
                    <div class="tab-pane fade" id="appliances" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Electrodomésticos Registrados</h6>
                            <a href="{{ route('homes.appliances.create', $home) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>
                        </div>
                        
                        @if($home->appliances->isEmpty())
                            <div class="alert alert-info">No hay electrodomésticos registrados.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Potencia (W)</th>
                                            <th>Uso Diario</th>
                                            <th>Consumo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($home->appliances as $appliance)
                                            <tr>
                                                <td>{{ $appliance->name }}</td>
                                                <td>{{ $appliance->power }} W</td>
                                                <td>{{ $appliance->hours_use }} hrs</td>
                                                <td>{{ number_format($appliance->daily_consumption, 2) }} kWh/día</td>
                                                <td>
                                                    <a href="{{ route('homes.appliances.show', [$home, $appliance]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('homes.appliances.edit', [$home, $appliance]) }}" class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    
                    <div class="tab-pane fade" id="lighting" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Sistemas de Iluminación</h6>
                            <a href="{{ route('homes.lightings.create', $home) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-circle"></i> Agregar
                            </a>
                        </div>
                        
                        @if($home->lightings->isEmpty())
                            <div class="alert alert-info">No hay sistemas de iluminación registrados.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Potencia (W)</th>
                                            <th>Cantidad</th>
                                            <th>Uso Diario</th>
                                            <th>Consumo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($home->lightings as $lighting)
                                            <tr>
                                                <td>{{ ucfirst($lighting->type) }}</td>
                                                <td>{{ $lighting->power }} W</td>
                                                <td>{{ $lighting->quantity }}</td>
                                                <td>{{ $lighting->hours_use }} hrs</td>
                                                <td>{{ number_format($lighting->daily_consumption, 2) }} kWh/día</td>
                                                <td>
                                                    <a href="{{ route('homes.lightings.show', [$home, $lighting]) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('homes.lightings.edit', [$home, $lighting]) }}" class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    
                    <div class="tab-pane fade" id="recommendations" role="tabpanel">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6>Recomendaciones de Ahorro</h6>
                            <form action="{{ route('homes.recommendations.generate', $home) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="bi bi-arrow-repeat"></i> Generar Nuevas
                                </button>
                            </form>
                        </div>
                        
                        @if($home->recommendations->isEmpty())
                            <div class="alert alert-info">No hay recomendaciones generadas. Haz clic en "Generar Nuevas" para obtener recomendaciones personalizadas.</div>
                        @else
                            <div class="list-group">
                                @foreach($home->recommendations as $recommendation)
                                    <div class="list-group-item">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">
                                                    @switch($recommendation->priority)
                                                        @case('high')
                                                            <span class="badge bg-danger me-2">Alta</span>
                                                            @break
                                                        @case('medium')
                                                            <span class="badge bg-warning me-2">Media</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-secondary me-2">Baja</span>
                                                    @endswitch
                                                    {{ $recommendation->description }}
                                                </h6>
                                                @if($recommendation->potential_savings)
                                                    <small class="text-success">
                                                        <i class="bi bi-lightning-charge"></i> Ahorro potencial: {{ number_format($recommendation->potential_savings, 2) }} kWh/mes
                                                    </small>
                                                @endif
                                            </div>
                                            @if(!$recommendation->implemented)
                                                <form action="{{ route('homes.recommendations.implement', [$home, $recommendation]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                                        <i class="bi bi-check-circle"></i> Marcar como implementada
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i> Implementada
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <h5 class="mb-0">Historial de Consumo</h5>
            </div>
            <div class="card-body">
                @if($home->energyConsumptions->isEmpty())
                    <div class="alert alert-info">No hay historial de consumo registrado.</div>
                @else
                    <div class="list-group">
                        @foreach($home->energyConsumptions as $consumption)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $consumption->period_date->format('M Y') }}</strong>
                                    <span>{{ number_format($consumption->total_consumption, 2) }} kWh</span>
                                </div>
                                <div class="d-flex justify-content-between small text-muted">
                                    <span>Costo estimado</span>
                                    <span>${{ number_format($consumption->estimated_cost, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3 text-center">
                        <a href="{{ route('homes.consumption.history', $home) }}" class="btn btn-sm btn-outline-primary">
                            Ver historial completo
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Metas de Ahorro</h5>
                <a href="{{ route('homes.goals.create', $home) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-circle"></i> Nueva Meta
                </a>
            </div>
            <div class="card-body">
                @if($home->goals->isEmpty())
                    <div class="alert alert-info">No hay metas de ahorro definidas.</div>
                @else
                    <div class="list-group">
                        @foreach($home->goals->take(3) as $goal)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $goal->name }}</h6>
                                        <small class="text-muted">Meta: {{ number_format($goal->target_consumption, 2) }} kWh para {{ $goal->target_date->format('M Y') }}</small>
                                    </div>
                                    <span class="badge bg-{{ $goal->status == 'achieved' ? 'success' : ($goal->status == 'failed' ? 'danger' : 'primary') }}">
                                        {{ ucfirst($goal->status) }}
                                    </span>
                                </div>
                                @if($goal->current_consumption)
                                    <div class="progress mt-2" style="height: 10px;">
                                        @php
                                            $percentage = min(100, ($goal->current_consumption / $goal->target_consumption) * 100);
                                        @endphp
                                        <div class="progress-bar bg-{{ $percentage <= 100 ? 'success' : 'danger' }}" role="progressbar" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block">
                                        Actual: {{ number_format($goal->current_consumption, 2) }} kWh ({{ number_format($percentage, 1) }}%)
                                    </small>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @if($home->goals->count() > 3)
                        <div class="mt-3 text-center">
                            <a href="{{ route('homes.goals.index', $home) }}" class="btn btn-sm btn-outline-primary">
                                Ver todas las metas
                            </a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inicializar pestañas
    const homeTabs = new bootstrap.Tab(document.getElementById('consumption-tab'));
    homeTabs.show();
</script>
@endpush