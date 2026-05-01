<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi carrito — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; }
        .cart-wrap { max-width: 860px; margin: 2.5rem auto; padding: 0 1.5rem; flex: 1; }
        .page-title { font-size: 1.6rem; font-weight: 700; color: #624F4F; margin-bottom: 1.5rem; }
        .cart-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(98,79,79,.1); overflow: hidden; margin-bottom: 1.5rem; }
        .cart-item { display: flex; align-items: center; gap: 1.25rem; padding: 1rem 1.5rem; border-bottom: 1px solid #f3eaea; }
        .cart-item:last-child { border-bottom: none; }
        .cart-img { width: 64px; height: 86px; object-fit: cover; border-radius: 6px; background: #FDE6E6; flex-shrink: 0; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .cart-img img { width: 100%; height: 100%; object-fit: cover; }
        .cart-img .placeholder-icon { color: #FFB2B2; font-size: 1.5rem; }
        .cart-info { flex: 1; min-width: 0; }
        .cart-titulo { font-weight: 600; font-size: .9rem; color: #1a1a1a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .cart-autor { font-size: .78rem; color: #624F4F; }
        .cart-unit-price { font-size: .78rem; color: #888; }
        .qty-wrap { display: flex; align-items: center; gap: .5rem; }
        .qty-btn { background: #FDE6E6; border: none; width: 28px; height: 28px; border-radius: 6px; font-size: .9rem; cursor: pointer; transition: background .15s; display: flex; align-items: center; justify-content: center; }
        .qty-btn:hover { background: #FFB2B2; }
        .qty-display { font-weight: 600; font-size: .9rem; min-width: 24px; text-align: center; }
        .item-subtotal { font-weight: 700; color: #5886B8; font-size: .95rem; min-width: 80px; text-align: right; }
        .remove-btn { background: none; border: none; color: #aaa; font-size: 1.1rem; cursor: pointer; transition: color .15s; }
        .remove-btn:hover { color: #e74c3c; }
        .summary-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(98,79,79,.1); padding: 1.5rem 2rem; }
        .summary-row { display: flex; justify-content: space-between; padding: .5rem 0; font-size: .9rem; border-bottom: 1px solid #f3eaea; }
        .summary-total { display: flex; justify-content: space-between; padding: .75rem 0; font-weight: 700; font-size: 1.1rem; color: #5886B8; }
        .btn-checkout { display: block; background: #5886B8; color: #fff; border: none; border-radius: 10px; padding: .85rem; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1rem; width: 100%; text-align: center; text-decoration: none; margin-top: 1rem; transition: opacity .2s; }
        .btn-checkout:hover { opacity: .88; color: #fff; }
        .btn-vaciar { background: none; border: 1.5px solid #FFB2B2; color: #7a1f1f; border-radius: 8px; padding: .45rem 1rem; font-family: 'Poppins', sans-serif; font-size: .8rem; font-weight: 600; cursor: pointer; transition: background .2s; }
        .btn-vaciar:hover { background: #FFB2B2; }
        .empty-cart { text-align: center; padding: 4rem 2rem; color: #888; }
        .empty-cart i { font-size: 4rem; color: #FFB2B2; display: block; margin-bottom: 1rem; }
        .btn-seguir { display: inline-block; background: #5886B8; color: #fff; border-radius: 10px; padding: .65rem 1.5rem; text-decoration: none; font-weight: 600; margin-top: 1rem; }
        .alert-flash { border-radius: 8px; padding: .75rem 1rem; margin-bottom: 1rem; font-size: .875rem; font-weight: 500; }
        .alert-flash.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-flash.error   { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }
    </style>
</head>
<body>


<x-loader />
<x-navbar />


<div class="cart-wrap">
    <h1 class="page-title"><i class="bi bi-bag me-2"></i>Mi carrito</h1>


    @if(session('success'))
        <div class="alert-flash success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-flash error">{{ session('error') }}</div>
    @endif


    @if(!$cart || $cart->details->isEmpty())
        <div class="cart-card">
            <div class="empty-cart">
                <i class="bi bi-bag-x"></i>
                <p class="fw-semibold">Tu carrito está vacío.</p>
                <p class="small">Explora el catálogo y añade libros que te gusten.</p>
                <a href="{{ route('dashboard') }}" class="btn-seguir">Ver catálogo</a>
            </div>
        </div>
    @else
        @php
            $hayInactivos = $cart->details->contains(fn($d) => !$d->book->activo);
        @endphp


        @if($hayInactivos)
            <div class="alert-flash error mb-3">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Algunos libros de tu carrito ya no están disponibles. Elimínalos para poder proceder al pago.
            </div>
        @endif


        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="small text-muted">{{ $cart->details->count() }} artículo(s)</span>
            <form method="POST" action="{{ route('carrito.clear') }}"
                  onsubmit="return confirm('¿Vaciar todo el carrito?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-vaciar"><i class="bi bi-trash me-1"></i>Vaciar carrito</button>
            </form>
        </div>


        <div class="cart-card">
            @foreach($cart->details as $detalle)
            @php $inactivo = !$detalle->book->activo; @endphp
            <div class="cart-item" style="{{ $inactivo ? 'opacity:.5;' : '' }}">
                <div class="cart-img">
                    @if($detalle->book->imagen_portada)
                        <img src="{{ asset('storage/' . $detalle->book->imagen_portada) }}"
                             alt="{{ $detalle->book->titulo }}">
                    @else
                        <div class="placeholder-icon w-100 h-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-book-half"></i>
                        </div>
                    @endif
                </div>
                <div class="cart-info">
                    <p class="cart-titulo" style="{{ $inactivo ? 'text-decoration:line-through;color:#aaa;' : '' }}">
                        {{ $detalle->book->titulo }}
                    </p>
                    <p class="cart-autor">{{ $detalle->book->author->nombre ?? '—' }}</p>
                    @if($inactivo)
                        <span style="font-size:.75rem;color:#e74c3c;font-weight:600;">
                            <i class="bi bi-x-circle me-1"></i>No disponible
                        </span>
                    @else
                        <p class="cart-unit-price">${{ number_format($detalle->precio_unitario, 2) }} c/u</p>
                    @endif
                </div>


                @if(!$inactivo)
                {{-- Ajustar cantidad --}}
                <div class="qty-wrap">
                    <form method="POST" action="{{ route('carrito.update', $detalle) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="cantidad" value="{{ max(1, $detalle->cantidad - 1) }}">
                        <button type="submit" class="qty-btn" {{ $detalle->cantidad <= 1 ? 'disabled' : '' }}>
                            <i class="bi bi-dash"></i>
                        </button>
                    </form>
                    <span class="qty-display">{{ $detalle->cantidad }}</span>
                    <form method="POST" action="{{ route('carrito.update', $detalle) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="cantidad" value="{{ $detalle->cantidad + 1 }}">
                        <button type="submit" class="qty-btn" {{ $detalle->cantidad >= $detalle->book->stock ? 'disabled' : '' }}>
                            <i class="bi bi-plus"></i>
                        </button>
                    </form>
                </div>
                <span class="item-subtotal">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                @else
                <div style="flex:1;"></div>
                @endif


                <form method="POST" action="{{ route('carrito.remove', $detalle) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="remove-btn" title="Eliminar"><i class="bi bi-x-lg"></i></button>
                </form>
            </div>
            @endforeach
        </div>


        <div class="summary-card">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            <div class="summary-row">
                <span>Envío</span>
                <span class="text-success">Gratis</span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span>${{ number_format($total, 2) }}</span>
            </div>
            @if($hayInactivos)
                <button class="btn-checkout" style="background:#c0c0c0;cursor:not-allowed;" disabled>
                    <i class="bi bi-exclamation-circle me-2"></i>Elimina los libros no disponibles
                </button>
            @else
                <a href="{{ route('carrito.checkout') }}" class="btn-checkout">
                    <i class="bi bi-credit-card me-2"></i>Proceder al pago
                </a>
            @endif
        </div>
    @endif
</div>


<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



