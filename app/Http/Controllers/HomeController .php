<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $libros     = Book::activos()->with(['author', 'category'])->orderByDesc('fecha_registro')->take(8)->get();
        $categorias = Category::orderBy('nombre')->get();
        return view('home', compact('libros', 'categorias'));
    }


    public function buscar(Request $request)
    {
        $q          = $request->input('q', '');
        $autorQ     = $request->input('autor', '');
        $categoriaId = $request->input('categoria', '');


        $query = Book::activos()->with(['author', 'category']);


        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('titulo', 'LIKE', "%{$q}%")
                    ->orWhere('descripcion', 'LIKE', "%{$q}%");
            });
        }


        if ($autorQ) {
            $query->whereHas('author', fn($sub) => $sub->where('nombre', 'LIKE', "%{$autorQ}%"));
        }


        if ($categoriaId) {
            $query->where('id_categoria', $categoriaId);
        }


        $libros     = $query->orderByDesc('fecha_registro')->paginate(12)->withQueryString();
        $categorias = Category::orderBy('nombre')->get();


        return view('buscar', compact('libros', 'categorias', 'q', 'autorQ', 'categoriaId'));
    }
}



