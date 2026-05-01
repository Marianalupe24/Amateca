<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $libros = Book::activos()
            ->with(['author', 'category'])
            ->orderByDesc('fecha_registro')
            ->paginate(12);


        $recomendaciones = $this->getRecommendations();


        return view('dashboard', compact('libros', 'recomendaciones'));
    }


    private function getRecommendations(): \Illuminate\Support\Collection
    {
        $userId = Auth::id();
        $cart   = Cart::where('id_usuario', $userId)->with('details.book')->first();


        if ($cart && $cart->details->isNotEmpty()) {
            $excludeIds  = $cart->details->pluck('id_libro')->toArray();
            $categoryIds = $cart->details->pluck('book.id_categoria')->filter()->unique()->toArray();


            if (!empty($categoryIds)) {
                return Book::activos()
                    ->with(['author', 'category'])
                    ->whereIn('id_categoria', $categoryIds)
                    ->whereNotIn('id', $excludeIds)
                    ->latest()
                    ->take(6)
                    ->get();
            }
        }


        return Book::activos()
            ->with(['author', 'category'])
            ->orderByDesc('fecha_registro')
            ->take(6)
            ->get();
    }
}



