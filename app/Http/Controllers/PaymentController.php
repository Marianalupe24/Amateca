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
            //Se crea la intencion de pago en Stripe
            $intent = PaymentIntent::create([
                //array asociativo 
                'amount'               => $amountCents,
                'currency'             => 'usd',
                'payment_method'       => $request->payment_method_id,
                'confirmation_method'  => 'manual',
                'confirm'              => true,
                'return_url'           => route('compra.exitosa'),
            ]);
            //En caso de error al procesar el pago
        } catch (CardException $e) {
            //Mensaje de error de stripe
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            //Cualquier otro error
            return response()->json(['error' => 'Error al procesar el pago. Intente de nuevo.'], 500);
        }

        //Si el pago fue exitoso
        if ($intent->status === 'succeeded') {
            //Transaccion para asegurar que se complete todo o nada
            DB::transaction(function () use ($cart, $total, $intent) {
                $factura = Factura::create([
                    'id_usuario'         => Auth::id(),
                    'total'              => $total,
                    'estado'             => 'pagado',
                    'stripe_payment_id'  => $intent->id,
                    'fecha'              => now()->toDateString(),
                ]);

                //Recorre todos los productos del carrito
                foreach ($cart->details as $detalle) {
                    //Se crea el detalle de la factura
                    $factura->detalles()->create([
                        //array asociativo 
                        'id_libro'        => $detalle->id_libro,
                        'cantidad'        => $detalle->cantidad,
                        'precio_unitario' => $detalle->precio_unitario,
                    ]);

                    //Se decrementa el stock del libro
                    $detalle->book->decrement('stock', $detalle->cantidad);
                }


                //Se elimina el carrito
                $cart->details()->delete();


                session(['ultima_factura_id' => $factura->id]);
            });

            //Se redirige al usuario a la pagina de exito
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
