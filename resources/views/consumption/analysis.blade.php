<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>Análisis de Consumo Energético</h5>
        <form action="{{ route('homes.consumption.store', $home) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="bi bi-save"></i> Guardar Análisis
            </button>
        </form>
    </div>
    
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h3 class="text-primary"> kWh</h3>
                    <p class="mb-0">Consumo diario estimado</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h3 class="text-primary"> kWh</h3>
                    <p class="mb-0">Consumo mensual estimado</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <h3 class="text-primary">$</h3>
                    <p class="mb-0">Costo mensual estimado</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Distribución del Consumo</h6>
                </div>
                <div class="card-body">
                    <canvas id="consumptionDistributionChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">Principales Consumidores</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Electrodoméstico</th>
                                    <th>Consumo Diario</th>
                                    <th>% Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Gráfico de distribución de consumo
    const distributionCtx = document.getElementById('consumptionDistributionChart').getContext('2d');
    const distributionChart = new Chart(distributionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Electrodomésticos', 'Iluminación'],
            datasets: [{
                data: [
                    
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw.toFixed(2) + ' kWh/día';
                            return label;
                        }
                    }
                }
            }
        }
    });
</script>
@endpush