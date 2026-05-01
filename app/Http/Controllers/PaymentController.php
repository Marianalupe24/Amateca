<?php


namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\CardException;


class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $request->validate([
            'payment_method_id' => 'required|string',
        ]);


        $cart = Cart::where('id_usuario', Auth::id())
            ->with(['details.book'])
            ->first();


        if (!$cart || $cart->details->isEmpty()) {
            return response()->json(['error' => 'Tu carrito está vacío.'], 422);
        }


        // Validar que todos los libros estén activos y con stock
        foreach ($cart->details as $detalle) {
            if (!$detalle->book->activo) {
                return response()->json([
                    'error' => "«{$detalle->book->titulo}» ya no está disponible.",
                ], 422);
            }
            if ($detalle->book->stock < $detalle->cantidad) {
                return response()->json([
                    'error' => "«{$detalle->book->titulo}» solo tiene {$detalle->book->stock} unidades en stock.",
                ], 422);
            }
        }


        $total = $cart->details->sum(fn($d) => $d->cantidad * $d->precio_unitario);
        $amountCents = (int) round($total * 100);


        Stripe::setApiKey(config('services.stripe.secret'));


        try {
            $intent = PaymentIntent::create([
                'amount'               => $amountCents,
                'currency'             => 'usd',
                'payment_method'       => $request->payment_method_id,
                'confirmation_method'  => 'manual',
                'confirm'              => true,
                'return_url'           => route('compra.exitosa'),
            ]);
        } catch (CardException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al procesar el pago. Intente de nuevo.'], 500);
        }


        if ($intent->status === 'succeeded') {
            DB::transaction(function () use ($cart, $total, $intent) {
                $factura = Factura::create([
                    'id_usuario'         => Auth::id(),
                    'total'              => $total,
                    'estado'             => 'pagado',
                    'stripe_payment_id'  => $intent->id,
                    'fecha'              => now()->toDateString(),
                ]);


                foreach ($cart->details as $detalle) {
                    $factura->detalles()->create([
                        'id_libro'        => $detalle->id_libro,
                        'cantidad'        => $detalle->cantidad,
                        'precio_unitario' => $detalle->precio_unitario,
                    ]);


                    // Reducir stock
                    $detalle->book->decrement('stock', $detalle->cantidad);
                }


                // Vaciar carrito
                $cart->details()->delete();


                session(['ultima_factura_id' => $factura->id]);
            });


            return response()->json(['success' => true, 'redirect' => route('compra.exitosa')]);
        }


        // Requiere acción adicional (3D Secure)
        if ($intent->status === 'requires_action') {
            return response()->json([
                'requires_action'       => true,
                'payment_intent_client_secret' => $intent->client_secret,
            ]);
        }


        // El pago falló
        Factura::create([
            'id_usuario'        => Auth::id(),
            'total'             => $total,
            'estado'            => 'fallido',
            'stripe_payment_id' => $intent->id ?? null,
            'fecha'             => now()->toDateString(),
        ]);


        return response()->json(['error' => 'El pago no fue aprobado. Verifica los datos de tu tarjeta.'], 422);
    }
}
