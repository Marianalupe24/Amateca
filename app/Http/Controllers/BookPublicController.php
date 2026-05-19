<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Factura;
use Illuminate\Support\Facades\Auth;


class BookPublicController extends Controller
{
    public function show(Book $book)
    {
        abort_if(!$book->activo, 404);


        $book->load(['author', 'category', 'comments.user']);

        $userComment = $book->comments->firstWhere('id_usuario', Auth::id());


        $hasPurchased = Factura::where('id_usuario', Auth::id())
            ->where('estado', 'pagado')
            ->whereHas('detalles', fn($q) => $q->where('id_libro', $book->id))
            ->exists();


        return view('libros.show', compact('book',  'userComment', 'hasPurchased'));
    }
}



