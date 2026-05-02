@extends('admin.layout')

@section('title', 'Reporte de Ventas')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    .metric-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(98,79,79,.08);
        border-left: 4px solid #5886B8;
    }
    .metric-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: #624F4F;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    .metric-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
    }
    .metric-subtitle {
        font-size: 0.8rem;
        color: #7f8c8d;
        margin-top: 0.25rem;
    }
    
    .charts-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    @media (max-width: 900px) {
        .charts-grid { grid-template-columns: 1fr; }
    }
    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }
    
    .tables-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    @media (max-width: 900px) {
        .tables-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="page-header">
    <h1>Reporte de Ventas</h1>
</div>

<div class="card" style="margin-bottom: 2rem;">
    <form action="{{ route('admin.sales-report') }}" method="GET" style="display: flex; gap: 1rem; align-items: flex-end;">
        <div class="form-group">
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ $fechaInicio }}">
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" value="{{ $fechaFin }}">
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </form>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-title">Total Ventas</div>
        <div class="metric-value">${{ number_format($totalVentas, 2) }}</div>
        <div class="metric-subtitle">En el periodo seleccionado</div>
    </div>
    <div class="metric-card" style="border-left-color: #624F4F;">
        <div class="metric-title">Pedidos Totales</div>
        <div class="metric-value">{{ $totalPedidos }}</div>
    </div>
    <div class="metric-card" style="border-left-color: #f39c12;">
        <div class="metric-title">Día de más ventas</div>
        <div class="metric-value">{{ $diaMasVentas }}</div>
    </div>
</div>

<div class="charts-grid">
    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Ventas por Mes (Últimos 12 meses)</h3>
        <div class="chart-container">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Pedidos por Estado</h3>
        <div class="chart-container">
            <canvas id="doughnutChart"></canvas>
        </div>
    </div>
</div>

<div class="tables-grid">
    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Top 10 Productos Más Vendidos</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th style="text-align: right;">Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topProductos as $prod)
                        <tr>
                            <td>{{ $prod->titulo }}</td>
                            <td style="text-align: right;">{{ $prod->total_vendido }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="text-align: center;">Sin datos en el periodo</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Categorías Destacadas</h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th style="text-align: right;">Unidades Vendidas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topCategorias as $cat)
                        <tr>
                            <td>{{ $cat->nombre }}</td>
                            <td style="text-align: right;">{{ $cat->total_vendido }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="text-align: center;">Sin datos en el periodo</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Line Chart (Ventas por Mes)
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const labelsMes = {!! json_encode($ventasPorMes->pluck('mes')) !!};
        const dataMes = {!! json_encode($ventasPorMes->pluck('total_ventas')) !!};
        
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labelsMes,
                datasets: [{
                    label: 'Ventas ($)',
                    data: dataMes,
                    borderColor: '#5886B8',
                    backgroundColor: 'rgba(88, 134, 184, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Doughnut Chart (Pedidos por Estado)
        const doughCtx = document.getElementById('doughnutChart').getContext('2d');
        const labelsEstado = {!! json_encode($pedidosPorEstado->pluck('estado')) !!};
        const dataEstado = {!! json_encode($pedidosPorEstado->pluck('total')) !!};
        
        new Chart(doughCtx, {
            type: 'doughnut',
            data: {
                labels: labelsEstado,
                datasets: [{
                    data: dataEstado,
                    backgroundColor: [
                        '#2ecc71', // Completado
                        '#f1c40f', // Pendiente
                        '#e74c3c', // Cancelado
                        '#3498db', // Procesando
                        '#9b59b6'  // Otros
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    });
</script>
@endsection
