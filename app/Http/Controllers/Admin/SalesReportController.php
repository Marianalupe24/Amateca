<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Factura;
use App\Models\FacturaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesReportController extends Controller
{
    public function index(Request $request)
    {
        $fechaInicio = $request->input('fecha_inicio', Carbon::now()->subDays(30)->toDateString());
        $fechaFin = $request->input('fecha_fin', Carbon::now()->toDateString());

        // Para evitar problemas de horas con la fecha final
        $fechaFinReal = Carbon::parse($fechaFin)->endOfDay();

        $facturasQuery = Factura::whereBetween('fecha', [$fechaInicio, $fechaFinReal]);

        // Total Ventas (suma de total en facturas no canceladas)
        $totalVentas = (clone $facturasQuery)->where('estado', '!=', 'cancelado')->sum('total');

        // Número total de pedidos
        $totalPedidos = (clone $facturasQuery)->count();

        // Productos más vendidos (Top 10)
        $topProductos = FacturaDetalle::join('facturas', 'detalle_factura.id_factura', '=', 'facturas.id')
            ->join('libros', 'detalle_factura.id_libro', '=', 'libros.id')
            ->whereBetween('facturas.fecha', [$fechaInicio, $fechaFinReal])
            ->where('facturas.estado', '!=', 'cancelado')
            ->select('libros.titulo', DB::raw('SUM(detalle_factura.cantidad) as total_vendido'))
            ->groupBy('libros.id', 'libros.titulo')
            ->orderByDesc('total_vendido')
            ->limit(10)
            ->get();

        // Ventas por mes (últimos 12 meses)
        $ventasPorMes = Factura::where('estado', '!=', 'cancelado')
            ->where('fecha', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->select(DB::raw('DATE_FORMAT(fecha, "%Y-%m") as mes'), DB::raw('SUM(total) as total_ventas'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Categorías más vendidas
        $topCategorias = FacturaDetalle::join('facturas', 'detalle_factura.id_factura', '=', 'facturas.id')
            ->join('libros', 'detalle_factura.id_libro', '=', 'libros.id')
            ->join('categorias', 'libros.id_categoria', '=', 'categorias.id')
            ->whereBetween('facturas.fecha', [$fechaInicio, $fechaFinReal])
            ->where('facturas.estado', '!=', 'cancelado')
            ->select('categorias.nombre', DB::raw('SUM(detalle_factura.cantidad) as total_vendido'))
            ->groupBy('categorias.id', 'categorias.nombre')
            ->orderByDesc('total_vendido')
            ->limit(5)
            ->get();

        // Pedidos por estado
        $pedidosPorEstado = (clone $facturasQuery)
            ->select('estado', DB::raw('COUNT(*) as total'))
            ->groupBy('estado')
            ->get();

        // Día de la semana con más ventas
        $diaSemana = Factura::whereBetween('fecha', [$fechaInicio, $fechaFinReal])
            ->where('estado', '!=', 'cancelado')
            ->select(DB::raw('DAYNAME(fecha) as dia'), DB::raw('SUM(total) as total_ventas'))
            ->groupBy(DB::raw('DAYNAME(fecha)'))
            ->orderByDesc('total_ventas')
            ->first();

        $diaMasVentas = $diaSemana ? $diaSemana->dia : 'N/A';
        $diasES = [
            'Monday' => 'Lunes', 'Tuesday' => 'Martes', 'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves', 'Friday' => 'Viernes', 'Saturday' => 'Sábado', 'Sunday' => 'Domingo'
        ];
        if (array_key_exists($diaMasVentas, $diasES)) {
            $diaMasVentas = $diasES[$diaMasVentas];
        }

        return view('admin.sales.report', compact(
            'fechaInicio', 'fechaFin', 'totalVentas', 'totalPedidos',
            'topProductos', 'ventasPorMes', 'topCategorias', 'pedidosPorEstado',
            'diaMasVentas'
        ));
    }
}
