<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Compra exitosa! — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; display: flex; flex-direction: column; min-height: 100vh; }
        .success-wrap { max-width: 640px; margin: 3rem auto; padding: 0 1.5rem; flex: 1; text-align: center; }
        .success-icon { font-size: 5rem; color: #5886B8; display: block; margin-bottom: 1rem; animation: pop .4s ease; }
        @keyframes pop { 0%{transform:scale(.5);opacity:0} 80%{transform:scale(1.1)} 100%{transform:scale(1);opacity:1} }
        .success-title { font-size: 1.75rem; font-weight: 700; color: #624F4F; margin-bottom: .5rem; }
        .success-sub { color: #888; font-size: .95rem; margin-bottom: 1.75rem; }
        .order-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(98,79,79,.1); padding: 1.75rem 2rem; margin-bottom: 1.5rem; text-align: left; }
        .factura-num { font-weight: 700; color: #624F4F; font-size: .95rem; margin-bottom: .25rem; }
        .item-row { display: flex; align-items: center; gap: 1rem; padding: .55rem 0; border-bottom: 1px solid #f3eaea; font-size: .875rem; }
        .item-row:last-child { border-bottom: none; }
        .item-title { flex: 1; font-weight: 500; }
        .item-price { font-weight: 700; color: #5886B8; }
        .total-row { display: flex; justify-content: space-between; font-weight: 700; font-size: 1.05rem; padding-top: .75rem; margin-top: .25rem; }
        .btn-action { display: inline-block; border-radius: 10px; padding: .7rem 1.75rem; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: .9rem; text-decoration: none; transition: opacity .2s; }
        .btn-action:hover { opacity: .88; }
        .btn-primary-act { background: #5886B8; color: #fff; }
        .btn-secondary-act { background: #FDE6E6; color: #624F4F; }
    </style>
</head>
<body>
<x-loader />
<x-navbar />


<div class="success-wrap">
    <i class="bi bi-check-circle-fill success-icon"></i>
    <h1 class="success-title">¡Pago realizado con éxito!</h1>
    <p class="success-sub">Gracias por tu compra. Tu pedido ha sido confirmado.</p>


    @php
        $facturaId = session('ultima_factura_id');
        $factura = $facturaId
            ? \App\Models\Factura::with('detalles.book')->find($facturaId)
            : null;
    @endphp


    @if($factura)
    <div class="order-card">
        <p class="factura-num">
            <i class="bi bi-receipt me-1"></i>
            Factura #{{ str_pad($factura->id, 6, '0', STR_PAD_LEFT) }}
            &nbsp;·&nbsp; {{ $factura->fecha?->format('d/m/Y') }}
        </p>


        <div style="margin-top:1rem;">
            @foreach($factura->detalles as $detalle)
            <div class="item-row">
                <span class="item-title">{{ $detalle->book->titulo ?? 'Libro' }}</span>
                <span style="color:#888;font-size:.8rem;">× {{ $detalle->cantidad }}</span>
                <span class="item-price">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
            </div>
            @endforeach
        </div>


        <div class="total-row">
            <span>Total pagado</span>
            <span style="color:#5886B8;">${{ number_format($factura->total, 2) }}</span>
        </div>
    </div>
    @endif


    <div class="d-flex gap-3 justify-content-center flex-wrap">
        <a href="{{ route('mis-compras') }}" class="btn-action btn-primary-act">
            <i class="bi bi-bag-check me-1"></i>Mis compras
        </a>
        <a href="{{ route('dashboard') }}" class="btn-action btn-secondary-act">
            <i class="bi bi-grid me-1"></i>Seguir comprando
        </a>
    </div>
</div>


<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





