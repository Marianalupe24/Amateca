<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        if (!$this->hasPurchased(Auth::id(), $book->id)) {
            return back()->with('error', 'Solo usuarios que han comprado este libro pueden calificarlo.');
        }


        $request->validate([
            'estrellas' => 'required|integer|min:1|max:5',
        ], [
            'estrellas.required' => 'Selecciona una calificación.',
            'estrellas.min'      => 'La calificación mínima es 1 estrella.',
            'estrellas.max'      => 'La calificación máxima es 5 estrellas.',
        ]);


        Rating::updateOrCreate(
            ['id_usuario' => Auth::id(), 'id_libro' => $book->id],
            ['estrellas'  => $request->estrellas]
        );


        return back()->with('success', 'Calificación guardada exitosamente.');
    }


    private function hasPurchased(int $userId, int $bookId): bool
    {
        // TODO: implementar verificación contra facturas/órdenes cuando se integre Stripe
        return false;
    }
}



