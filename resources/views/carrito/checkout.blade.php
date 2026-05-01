<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; display: flex; flex-direction: column; min-height: 100vh; }
        .checkout-wrap { max-width: 820px; margin: 2.5rem auto; padding: 0 1.5rem; flex: 1; }
        .page-title { font-size: 1.5rem; font-weight: 700; color: #624F4F; margin-bottom: 1.75rem; }
        .checkout-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(98,79,79,.1); padding: 2rem; margin-bottom: 1.5rem; }
        .section-label { font-weight: 700; color: #624F4F; font-size: 1rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: .5rem; }
        .form-label-sm { font-size: .8rem; font-weight: 600; color: #624F4F; }
        .form-control { border: 1.5px solid #e0d4d4; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: .875rem; }
        .form-control:focus { border-color: #5886B8; box-shadow: none; }
        .form-control:disabled, .form-control[readonly] { background: #f8f4f4; color: #888; }
        .order-item { display: flex; align-items: center; gap: 1rem; padding: .65rem 0; border-bottom: 1px solid #f3eaea; font-size: .875rem; }
        .order-item:last-child { border-bottom: none; }
        .order-item-title { flex: 1; font-weight: 500; color: #1a1a1a; }
        .order-item-qty { color: #888; font-size: .78rem; }
        .order-item-price { font-weight: 600; color: #5886B8; }
        .total-row { display: flex; justify-content: space-between; font-weight: 700; font-size: 1.1rem; color: #1a1a1a; padding-top: .75rem; margin-top: .5rem; }
        .back-btn { display: inline-flex; align-items: center; gap: .35rem; color: #624F4F; text-decoration: none; font-size: .875rem; font-weight: 500; margin-bottom: 1.25rem; }
        .back-btn:hover { color: #5886B8; }
        /* Stripe card element */
        #card-element { border: 1.5px solid #e0d4d4; border-radius: 8px; padding: .75rem 1rem; background: #fff; transition: border-color .2s; }
        #card-element.StripeElement--focus { border-color: #5886B8; }
        #card-element.StripeElement--invalid { border-color: #e74c3c; }
        #card-errors { color: #e74c3c; font-size: .8rem; margin-top: .35rem; min-height: 1.2em; }
        .btn-pay { display: block; width: 100%; background: #5886B8; color: #fff; border: none; border-radius: 10px; padding: .85rem; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1rem; cursor: pointer; transition: opacity .2s; margin-top: .75rem; }
        .btn-pay:hover:not(:disabled) { opacity: .88; }
        .btn-pay:disabled { background: #c0c0c0; cursor: not-allowed; }
        .test-card-banner { background: #FDE6E6; border: 1px dashed #FFB2B2; border-radius: 10px; padding: .85rem 1.1rem; font-size: .8rem; color: #624F4F; margin-bottom: 1rem; }
        .test-card-banner code { background: #fff; padding: .15rem .4rem; border-radius: 4px; font-size: .8rem; }
        .spinner { display: none; width: 1.1rem; height: 1.1rem; border: 2px solid #fff; border-top-color: transparent; border-radius: 50%; animation: spin .6s linear infinite; vertical-align: middle; margin-right: .4rem; }
        @keyframes spin { to { transform: rotate(360deg); } }
    </style>
</head>
<body>


<x-loader />
<x-navbar />


<div class="checkout-wrap">
    <a href="{{ route('carrito.index') }}" class="back-btn">
        <i class="bi bi-arrow-left"></i> Volver al carrito
    </a>


    <h1 class="page-title"><i class="bi bi-credit-card me-2"></i>Finalizar compra</h1>


    <div class="row g-4">
        <div class="col-12 col-md-7">


            {{-- Datos de envío --}}
            <div class="checkout-card">
                <p class="section-label"><i class="bi bi-geo-alt-fill"></i>Datos de envío</p>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label form-label-sm">Nombre completo</label>
                        <input type="text" class="form-control"
                               value="{{ Auth::user()->name }} {{ Auth::user()->apellido }}" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label form-label-sm">Dirección de entrega</label>
                        <input type="text" class="form-control" id="direccion" placeholder="Calle, número, colonia...">
                    </div>
                    <div class="col-6">
                        <label class="form-label form-label-sm">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" placeholder="San Salvador">
                    </div>
                    <div class="col-6">
                        <label class="form-label form-label-sm">Teléfono</label>
                        <input type="text" class="form-control"
                               value="{{ Auth::user()->telefono }}" placeholder="7890-1234">
                    </div>
                </div>
            </div>


            {{-- Pago con Stripe --}}
            <div class="checkout-card">
                <p class="section-label"><i class="bi bi-lock-fill"></i>Pago seguro con Stripe</p>


                <div class="test-card-banner">
                    <i class="bi bi-info-circle me-1"></i>
                    <strong>Modo prueba.</strong> Usa la tarjeta:
                    <code>4242 4242 4242 4242</code> — fecha futura — CVV: cualquier 3 dígitos.
                </div>


                <label class="form-label form-label-sm mb-2">Datos de tarjeta</label>
                <div id="card-element"></div>
                <div id="card-errors"></div>
            </div>
        </div>


        <div class="col-12 col-md-5">
            {{-- Resumen del pedido --}}
            <div class="checkout-card">
                <p class="section-label"><i class="bi bi-receipt"></i>Resumen del pedido</p>


                @foreach($cart->details as $detalle)
                <div class="order-item">
                    <div>
                        <p class="order-item-title">{{ $detalle->book->titulo }}</p>
                        <p class="order-item-qty">Cantidad: {{ $detalle->cantidad }}</p>
                    </div>
                    <span class="order-item-price">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</span>
                </div>
                @endforeach


                <div class="total-row">
                    <span>Total</span>
                    <span style="color:#5886B8;">${{ number_format($total, 2) }}</span>
                </div>


                <button id="pay-btn" class="btn-pay">
                    <span class="spinner" id="spinner"></span>
                    <i class="bi bi-lock-fill me-1"></i>Pagar ${{ number_format($total, 2) }}
                </button>
                <div id="pay-error" style="color:#e74c3c;font-size:.8rem;margin-top:.5rem;text-align:center;"></div>
            </div>
        </div>
    </div>
</div>


<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    const stripe  = Stripe('{{ config("services.stripe.key") }}');
    const elements = stripe.elements();


    const cardElement = elements.create('card', {
        style: {
            base: {
                fontFamily: "'Poppins', sans-serif",
                fontSize: '14px',
                color: '#1a1a1a',
                '::placeholder': { color: '#aaa' },
            },
            invalid: { color: '#e74c3c' },
        },
    });
    cardElement.mount('#card-element');


    cardElement.on('change', ({ error }) => {
        document.getElementById('card-errors').textContent = error ? error.message : '';
    });


    document.getElementById('pay-btn').addEventListener('click', async () => {
        const btn     = document.getElementById('pay-btn');
        const spinner = document.getElementById('spinner');
        const payErr  = document.getElementById('pay-error');


        btn.disabled = true;
        spinner.style.display = 'inline-block';
        payErr.textContent = '';


        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: '{{ Auth::user()->name }} {{ Auth::user()->apellido }}',
            },
        });


        if (error) {
            payErr.textContent = error.message;
            btn.disabled = false;
            spinner.style.display = 'none';
            return;
        }


        try {
            const res = await fetch('{{ route("pagar") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ payment_method_id: paymentMethod.id }),
            });


            const data = await res.json();


            if (data.requires_action) {
                const { error: confirmError } = await stripe.handleCardAction(
                    data.payment_intent_client_secret
                );
                if (confirmError) {
                    payErr.textContent = confirmError.message;
                    btn.disabled = false;
                    spinner.style.display = 'none';
                    return;
                }
                // Re-enviar con payment_intent confirmado
                const res2 = await fetch('{{ route("pagar") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ payment_method_id: paymentMethod.id }),
                });
                const data2 = await res2.json();
                if (data2.success) {
                    window.location.href = data2.redirect;
                    return;
                }
                payErr.textContent = data2.error || 'Error al procesar el pago.';
            } else if (data.success) {
                window.location.href = data.redirect;
            } else {
                payErr.textContent = data.error || 'Error al procesar el pago.';
            }
        } catch (e) {
            payErr.textContent = 'Error de conexión. Intenta de nuevo.';
        }


        btn.disabled = false;
        spinner.style.display = 'none';
    });
})();
</script>
</body>
</html>





