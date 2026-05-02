@extends('admin.layout')

@section('title', 'Dashboard')

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

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    @media (max-width: 900px) {
        .dashboard-grid { grid-template-columns: 1fr; }
    }

    .chart-container {
        position: relative;
        height: 300px;
        width: 100%;
    }

    .recent-table-wrap {
        overflow-x: auto;
    }
    .recent-table-wrap table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    .recent-table-wrap th {
        text-align: left;
        padding: 0.75rem;
        border-bottom: 2px solid #f3eaea;
        color: #624F4F;
    }
    .recent-table-wrap td {
        padding: 0.75rem;
        border-bottom: 1px solid #f3eaea;
    }
    
    .low-stock-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3eaea;
    }
    .low-stock-item:last-child {
        border-bottom: none;
    }
    .stock-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.75rem;
    }
    .stock-critical { background: #ffebee; color: #c62828; }
    .stock-warning { background: #fff3e0; color: #ef6c00; }

    .quick-links {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }
</style>

<div class="page-header">
    <h1>Dashboard Principal</h1>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-title">Ventas del Mes</div>
        <div class="metric-value">${{ number_format($ventasMesActual, 2) }}</div>
    </div>
    <div class="metric-card" style="border-left-color: #2ecc71;">
        <div class="metric-title">Pedidos del Mes</div>
        <div class="metric-value">{{ $pedidosMesActual }}</div>
    </div>
    <div class="metric-card" style="border-left-color: #f39c12;">
        <div class="metric-title">Productos Activos</div>
        <div class="metric-value">{{ $productosActivos }}</div>
    </div>
    <div class="metric-card" style="border-left-color: #9b59b6;">
        <div class="metric-title">Empleados Activos</div>
        <div class="metric-value">{{ $empleadosActivos }}</div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- SECCIÓN CENTRAL: Gráfica y Pedidos -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card">
            <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Ventas de los Últimos 7 Días</h3>
            <div class="chart-container">
                <canvas id="ventasChart"></canvas>
            </div>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Últimos 5 Pedidos</h3>
            <div class="recent-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th># Pedido</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosPedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ optional($pedido->user)->name ?? 'N/A' }}</td>
                                <td>${{ number_format($pedido->total, 2) }}</td>
                                <td>
                                    <span class="badge {{ $pedido->estado === 'completado' ? 'badge-active' : 'badge-inactive' }}">
                                        {{ ucfirst($pedido->estado) }}
                                    </span>
                                </td>
                                <td>{{ $pedido->fecha->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" style="text-align: center;">No hay pedidos recientes.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SECCIÓN INFERIOR: Stock y Accesos Rápidos -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="card">
            <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Productos con Bajo Stock</h3>
            <div>
                @forelse($productosBajoStock as $producto)
                    <div class="low-stock-item">
                        <span style="font-size: 0.85rem;">{{ $producto->titulo }}</span>
                        <span class="stock-badge {{ $producto->stock < 5 ? 'stock-critical' : 'stock-warning' }}">
                            {{ $producto->stock }} en stock
                        </span>
                    </div>
                @empty
                    <p style="font-size: 0.85rem; color: #7f8c8d;">No hay productos con bajo stock.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <h3 style="margin-bottom: 1rem; color: #624F4F; font-size: 1.1rem;">Accesos Rápidos</h3>
            <div class="quick-links">
                <a href="{{ route('admin.libros.create') }}" class="btn btn-primary" style="justify-content: center;">Agregar Producto</a>
                {{-- Nota: la ruta de pedidos podría no existir aún, si no, se puede omitir o apuntar a una general --}}
                {{-- <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary" style="justify-content: center;">Ver Pedidos</a> --}}
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary" style="justify-content: center;">Ver Empleados</a>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('ventasChart').getContext('2d');
        const labels = {!! json_encode($ultimos7Dias->pluck('fecha')->reverse()->values()) !!};
        const data = {!! json_encode($ultimos7Dias->pluck('total')->reverse()->values()) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas ($)',
                    data: data,
                    backgroundColor: '#5886B8',
                    borderRadius: 4
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
    });
</script>
@endsection
