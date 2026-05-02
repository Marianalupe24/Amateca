<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        // Total ventas y pedidos del mes actual (facturas no canceladas)
        $ventasMesActual = Factura::whereMonth('fecha', $mesActual)
            ->whereYear('fecha', $anioActual)
            ->where('estado', '!=', 'cancelado')
            ->sum('total');

        $pedidosMesActual = Factura::whereMonth('fecha', $mesActual)
            ->whereYear('fecha', $anioActual)
            ->where('estado', '!=', 'cancelado')
            ->count();

        // Total de productos activos en catálogo
        $productosActivos = Book::where('activo', true)->count();

        // Total de empleados activos
        $empleadosActivos = User::where('rol', 'empleado')->count();

        // Gráfica de barras: ventas de los últimos 7 días
        $ultimos7Dias = collect();
        for ($i = 6; $i >= 0; $i--) {
            $fecha = Carbon::now()->subDays($i)->format('Y-m-d');
            $ventasDia = Factura::whereDate('fecha', $fecha)
                ->where('estado', '!=', 'cancelado')
                ->sum('total');
            $ultimos7Dias->push([
                'fecha' => Carbon::now()->subDays($i)->format('d/m'),
                'total' => $ventasDia
            ]);
        }

        // Últimos 5 pedidos recientes
        $ultimosPedidos = Factura::with('user')
            ->latest('fecha')
            ->take(5)
            ->get();

        // Productos con menos stock (Top 5)
        $productosBajoStock = Book::where('activo', true)
            ->orderBy('stock', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'ventasMesActual',
            'pedidosMesActual',
            'productosActivos',
            'empleadosActivos',
            'ultimos7Dias',
            'ultimosPedidos',
            'productosBajoStock'
        ));
    }
}
