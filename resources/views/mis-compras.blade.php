<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Compras — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; display: flex; flex-direction: column; min-height: 100vh; }
        .purchases-wrap { max-width: 860px; margin: 2.5rem auto; padding: 0 1.5rem; flex: 1; }
        .page-title { font-size: 1.5rem; font-weight: 700; color: #624F4F; margin-bottom: 1.75rem; }
        .order-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(98,79,79,.1); margin-bottom: 1.25rem; overflow: hidden; }
        .order-header { display: flex; align-items: center; justify-content: space-between; padding: 1rem 1.5rem; background: #FDE6E6; cursor: pointer; user-select: none; }
        .order-num { font-weight: 700; color: #624F4F; font-size: .9rem; }
        .order-date { font-size: .8rem; color: #888; }
        .order-total { font-weight: 700; color: #5886B8; font-size: 1rem; }
        .order-badge { padding: .25rem .75rem; border-radius: 20px; font-size: .75rem; font-weight: 600; }
        .badge-pagado { background: #d4edda; color: #155724; }
        .order-body { display: none; padding: 1rem 1.5rem; border-top: 1px solid #FDE6E6; }
        .order-body.open { display: block; }
        .item-row { display: flex; align-items: center; gap: 1rem; padding: .6rem 0; border-bottom: 1px solid #f3eaea; font-size: .875rem; }
        .item-row:last-child { border-bottom: none; }
        .item-img { width: 48px; height: 64px; object-fit: cover; border-radius: 4px; background: #FDE6E6; flex-shrink: 0; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .item-img img { width: 100%; height: 100%; object-fit: cover; }
        .item-title { flex: 1; font-weight: 600; color: #1a1a1a; }
        .item-qty { color: #888; }
        .item-price { font-weight: 700; color: #5886B8; min-width: 80px; text-align: right; }
        .empty-state { text-align: center; padding: 4rem 2rem; color: #888; }
        .empty-state i { font-size: 4rem; color: #FFB2B2; display: block; margin-bottom: 1rem; }
        .btn-dashboard { display: inline-block; background: #5886B8; color: #fff; border-radius: 10px; padding: .65rem 1.5rem; text-decoration: none; font-weight: 600; margin-top: 1rem; font-size: .875rem; }
        .chevron { transition: transform .2s; }
        .chevron.open { transform: rotate(180deg); }
    </style>
</head>
<body>
<x-loader />
<x-navbar />

<div class="purchases-wrap">
    <h1 class="page-title"><i class="bi bi-bag-check me-2"></i>Mis Compras</h1>


    @if($facturas->isEmpty())
        <div class="order-card">
            <div class="empty-state">
                <i class="bi bi-bag-x"></i>
                <p class="fw-semibold">Aún no has realizado ninguna compra.</p>
                <p class="small">Explora el catálogo y encuentra tu próxima lectura.</p>
                <a href="{{ route('dashboard') }}" class="btn-dashboard">Ver catálogo</a>
            </div>
        </div>
    @else
        @foreach($facturas as $factura)
        <div class="order-card">
            <div class="order-header" onclick="toggleOrder({{ $factura->id }})">
                <div>
                    <p class="order-num">Factura #{{ str_pad($factura->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <p class="order-date">{{ $factura->fecha?->format('d/m/Y') }}</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="order-badge badge-pagado">Pagado</span>
                    <span class="order-total">${{ number_format($factura->total, 2) }}</span>
                    <i class="bi bi-chevron-down chevron" id="chevron-{{ $factura->id }}"></i>
                </div>
            </div>
            <div class="order-body" id="order-{{ $factura->id }}">
                @foreach($factura->detalles as $detalle)
                <div class="item-row">
                    <div class="item-img">
                        @if($detalle->book?->imagen_portada)
                            <img src="{{ asset('storage/' . $detalle->book->imagen_portada) }}"
                                 alt="{{ $detalle->book->titulo }}">
                        @else
                            <i class="bi bi-book-half" style="color:#FFB2B2;font-size:1.2rem;"></i>
                        @endif
                    </div>
                    <span class="item-title">{{ $detalle->book->titulo ?? 'Libro eliminado' }}</span>
                    <span class="item-qty">× {{ $detalle->cantidad }}</span>
                    <span class="item-price">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                </div>
                @endforeach
                <div class="d-flex justify-content-end pt-2">
                    <strong style="font-size:.9rem;color:#5886B8;">
                        Total: ${{ number_format($factura->total, 2) }}
                    </strong>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>


<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleOrder(id) {
    const body    = document.getElementById('order-' + id);
    const chevron = document.getElementById('chevron-' + id);
    body.classList.toggle('open');
    chevron.classList.toggle('open');
}
</script>
</body>
</html>





