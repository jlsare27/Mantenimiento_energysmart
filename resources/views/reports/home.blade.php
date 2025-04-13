<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Consumo - {{ $home->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .subtitle { font-size: 14px; color: #555; }
        .section { margin-bottom: 15px; }
        .section-title { font-size: 16px; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
        .chart-container { margin: 20px 0; text-align: center; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Reporte de Consumo Energético</div>
        <div class="subtitle">{{ $home->name }} - Generado el {{ now()->format('d/m/Y') }}</div>
    </div>
    
    <div class="section">
        <div class="section-title">Información del Hogar</div>
        <table class="table">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $home->name }}</td>
                <td><strong>Dirección:</strong></td>
                <td>{{ $home->address }}, {{ $home->city }}</td>
            </tr>
            <tr>
                <td><strong>Tipo de conexión:</strong></td>
                <td>{{ ucfirst($home->connection_type) }}</td>
                <td><strong>Tarifa energética:</strong></td>
                <td>${{ number_format($home->energy_tariff, 4) }} por kWh</td>
            </tr>
        </table>
    </div>
    
    <div class="section">
        <div class="section-title">Resumen de Consumo</div>
        @if(!$home->energyConsumptions->isEmpty())
            @php
                $latestConsumption = $home->energyConsumptions->first();
            @endphp
            <table class="table">
                <tr>
                    <td><strong>Último período registrado:</strong></td>
                    <td>{{ $latestConsumption->period_date->format('F Y') }}</td>
                    <td><strong>Consumo total:</strong></td>
                    <td>{{ number_format($latestConsumption->total_consumption, 2) }} kWh</td>
                </tr>
                <tr>
                    <td><strong>Costo estimado:</strong></td>
                    <td>${{ number_format($latestConsumption->estimated_cost, 2) }}</td>
                    <td><strong>Consumo electrodomésticos:</strong></td>
                    <td>{{ number_format($latestConsumption->breakdown['appliances'], 2) }} kWh</td>
                </tr>
                <tr>
                    <td><strong>Consumo iluminación:</strong></td>
                    <td>{{ number_format($latestConsumption->breakdown['lighting'], 2) }} kWh</td>
                    <td><strong>Principales consumidores:</strong></td>
                    <td>
                        @foreach($latestConsumption->breakdown['top_consumers'] as $consumer)
                            {{ $consumer }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
            </table>
        @else
            <p>No hay datos de consumo registrados.</p>
        @endif
    </div>
    
    <div class="section">
        <div class="section-title">Historial de Consumo (últimos 6 meses)</div>
        @if(!$home->energyConsumptions->isEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Período</th>
                        <th>Consumo Total (kWh)</th>
                        <th>Costo Estimado</th>
                        <th>Electrodomésticos (kWh)</th>
                        <th>Iluminación (kWh)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($home->energyConsumptions->take(6) as $consumption)
                        <tr>
                            <td>{{ $consumption->period_date->format('M Y') }}</td>
                            <td>{{ number_format($consumption->total_consumption, 2) }}</td>
                            <td>${{ number_format($consumption->estimated_cost, 2) }}</td>
                            <td>{{ number_format($consumption->breakdown['appliances'], 2) }}</td>
                            <td>{{ number_format($consumption->breakdown['lighting'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay historial de consumo disponible.</p>
        @endif
    </div>
    
    <div class="section">
        <div class="section-title">Recomendaciones de Ahorro</div>
        @if(!$home->recommendations->isEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Prioridad</th>
                        <th>Recomendación</th>
                        <th>Ahorro Potencial</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($home->recommendations->sortByDesc('priority') as $recommendation)
                        <tr>
                            <td>{{ ucfirst($recommendation->priority) }}</td>
                            <td>{{ $recommendation->description }}</td>
                            <td>
                                @if($recommendation->potential_savings)
                                    {{ number_format($recommendation->potential_savings, 2) }} kWh/mes
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $recommendation->implemented ? 'Implementada' : 'Pendiente' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay recomendaciones generadas.</p>
        @endif
    </div>
    
    <div class="footer">
        Reporte generado por EnergySmart - {{ date('Y') }}
    </div>
</body>
</html>