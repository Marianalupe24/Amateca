<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'book'])->orderByDesc('created_at');

        if ($request->filled('libro')) {
            $query->whereHas('book', fn($q) => $q->where('titulo', 'LIKE', "%{$request->libro}%"));
        }

        if ($request->filled('usuario')) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'LIKE', "%{$request->usuario}%")
                  ->orWhere('apellido', 'LIKE', "%{$request->usuario}%")
            );
        }

        $comentarios = $query->paginate(20)->withQueryString();
        return view('admin.comentarios.index', compact('comentarios'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comentario eliminado exitosamente.');
    }
}
