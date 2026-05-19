<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function index()
    {
        $cart  = Cart::where('id_usuario', Auth::id())->with(['details.book.author'])->first();
        $total = $cart ? $cart->details->sum(fn($d) => $d->cantidad * $d->precio_unitario) : 0;


        return view('carrito.index', compact('cart', 'total'));
    }


    public function add(Book $book)
    {
        if (!$book->activo) {
            return back()->with('error', 'Este libro no está disponible actualmente.');
        }


        if ($book->stock <= 0) {
            return back()->with('error', 'Este libro no tiene stock disponible.');
        }


        $cart   = Cart::firstOrCreate(['id_usuario' => Auth::id()]);
        $detalle = $cart->details()->where('id_libro', $book->id)->first();


        if ($detalle) {
            if ($detalle->cantidad >= $book->stock) {
                return back()->with('error', 'No hay más unidades disponibles en stock.');
            }
            $detalle->increment('cantidad');
        } else {
            $cart->details()->create([
                'id_libro'        => $book->id,
                'cantidad'        => 1,
                'precio_unitario' => $book->precio,
            ]);
        }


        return back()->with('success', "{$book->titulo} añadido al carrito.");
    }


    public function update(Request $request, CartDetail $detalle)
    {
        $this->authorizeItem($detalle);
        $request->validate(['cantidad' => 'required|integer|min:1|max:99']);


        if ($request->cantidad > $detalle->book->stock) {
            return back()->with('error', 'No hay suficiente stock para esa cantidad.');
        }


        $detalle->update(['cantidad' => $request->cantidad]);
        return back()->with('success', 'Cantidad actualizada.');
    }


    public function remove(CartDetail $detalle)
    {
        $this->authorizeItem($detalle);
        $detalle->delete();
        return back()->with('success', 'Libro eliminado del carrito.');
    }


    public function clear()
    {
        Cart::where('id_usuario', Auth::id())->first()?->details()->delete();
        return back()->with('success', 'Carrito vaciado.');
    }


    public function checkout()
    {
        $cart = Cart::where('id_usuario', Auth::id())->with(['details.book.author'])->first();


        if (!$cart || $cart->details->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }


        // Validación final: libros activos y con stock suficiente
        $problemas = [];
        foreach ($cart->details as $detalle) {
            if (!$detalle->book->activo) {
                $problemas[] = "«{$detalle->book->titulo}» ya no está disponible.";
            } elseif ($detalle->book->stock < $detalle->cantidad) {
                $problemas[] = "«{$detalle->book->titulo}» solo tiene {$detalle->book->stock} unidades disponibles.";
            }
        }


        if (!empty($problemas)) {
            return redirect()->route('carrito.index')
                ->with('error', 'No se puede proceder: ' . implode(' ', $problemas));
        }


        $total = $cart->details->sum(fn($d) => $d->cantidad * $d->precio_unitario);
        return view('carrito.checkout', compact('cart', 'total'));
    }


    private function authorizeItem(CartDetail $detalle): void
    {
        $cart = Cart::where('id_usuario', Auth::id())->first();
        abort_if(!$cart || $detalle->id_carrito !== $cart->id, 403);
    }
}



