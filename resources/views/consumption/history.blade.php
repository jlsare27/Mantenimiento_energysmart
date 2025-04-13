@extends('layouts.app')

@section('title', 'Historial de Consumo - ' . $home->name)

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Historial de Consumo - {{ $home->name }}</h5>
        <div>
            <a href="{{ route('homes.reports.pdf', $home) }}" class="btn btn-sm btn-outline-danger me-2">
                <i class="bi bi-file-pdf"></i> Exportar PDF
            </a>
            <a href="{{ route('homes.reports.excel', $home) }}" class="btn btn-sm btn-outline-success">
                <i class="bi bi-file-excel"></i> Exportar Excel
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($consumptions->isEmpty())
            <div class="alert alert-info">No hay registros de consumo para mostrar.</div>
        @else
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Periodo</th>
                            <th>Consumo Total</th>
                            <th>Costo Estimado</th>
                            <th>Electrodomésticos</th>
                            <th>Iluminación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consumptions as $consumption)
                            <tr>
                                <td>{{ $consumption->period_date->format('F Y') }}</td>
                                <td>{{ number_format($consumption->total_consumption, 2) }} kWh</td>
                                <td>${{ number_format($consumption->estimated_cost, 2) }}</td>
                                <td>{{ number_format($consumption->breakdown['appliances'], 2) }} kWh</td>
                                <td>{{ number_format($consumption->breakdown['lighting'], 2) }} kWh</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#consumptionModal{{ $consumption->id }}">
                                        <i class="bi bi-eye"></i> Detalles
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="consumptionModal{{ $consumption->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detalles de Consumo - {{ $consumption->period_date->format('F Y') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-4">
                                                <div class="col-md-4">
                                                    <div class="card bg-light">
                                                        <div class="card-body text-center">
                                                            <h3 class="mb-0">{{ number_format($consumption->total_consumption, 2) }}</h3>
                                                            <small class="text-muted">kWh totales</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card bg-light">
                                                        <div class="card-body text-center">
                                                            <h3 class="mb-0">${{ number_format($consumption->estimated_cost, 2) }}</h3>
                                                            <small class="text-muted">Costo total</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="card bg-light">
                                                        <div class="card-body text-center">
                                                            <h3 class="mb-0">{{ $home->energy_tariff }}</h3>
                                                            <small class="text-muted">Tarifa (kWh)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Distribución del Consumo</h6>
                                                    <canvas id="modalChart{{ $consumption->id }}" height="200"></canvas>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Principales Consumidores</h6>
                                                    <ul class="list-group">
                                                        @foreach($consumption->breakdown['top_consumers'] as $consumer)
                                                            <li class="list-group-item">{{ $consumer }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @push('scripts')
                            <script>
                                // Gráfico para el modal
                                document.addEventListener('DOMContentLoaded', function() {
                                    const modalCtx = document.getElementById('modalChart{{ $consumption->id }}').getContext('2d');
                                    new Chart(modalCtx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Electrodomésticos', 'Iluminación'],
                                            datasets: [{
                                                data: [
                                                    {{ $consumption->breakdown['appliances'] }}, 
                                                    {{ $consumption->breakdown['lighting'] }}
                                                ],
                                                backgroundColor: [
                                                    'rgba(54, 162, 235, 0.7)',
                                                    'rgba(255, 206, 86, 0.7)'
                                                ]
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                legend: {
                                                    position: 'bottom',
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                            @endpush
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $consumptions->links() }}
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