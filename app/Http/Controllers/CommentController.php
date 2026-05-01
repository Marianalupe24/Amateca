<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $exists = Comment::where('id_usuario', Auth::id())->where('id_libro', $book->id)->exists();


        if ($exists) {
            return back()->with('error', 'Ya dejaste un comentario en este libro.');
        }


        $request->validate([
            'comentario' => 'required|min:10|max:500',
        ], [
            'comentario.required' => 'El comentario es obligatorio.',
            'comentario.min'      => 'El comentario debe tener al menos 10 caracteres.',
            'comentario.max'      => 'El comentario no puede superar los 500 caracteres.',
        ]);


        $texto = $this->sanitize($request->comentario);


        if ($this->hasBadWords($texto)) {
            return back()
                ->with('error', 'Tu comentario contiene palabras inapropiadas. Por favor, revísalo.')
                ->withInput();
        }


        Comment::create([
            'id_usuario' => Auth::id(),
            'id_libro'   => $book->id,
            'comentario' => $texto,
            'fecha'      => now()->toDateString(),
        ]);


        return back()->with('success', 'Comentario publicado exitosamente.');
    }


    private function sanitize(string $text): string
    {
        $text = strip_tags($text);
        $text = preg_replace('/https?:\/\/\S+/i', '', $text);
        $text = preg_replace('/[a-zA-Z]:\\\\[^\s]*/u', '', $text);
        $text = preg_replace('/\b(DROP|SELECT|INSERT|DELETE|UPDATE|UNION|ALTER|CREATE|EXEC|SCRIPT)\b/i', '', $text);
        return trim($text);
    }


    private function hasBadWords(string $text): bool
    {
        $list = [
            'mierda','puta','puto','pendejo','cabrón','cabron','chingada','chingar',
            'coño','verga','culo','joder','polla','marica','idiota','imbécil','imbecil',
            'estúpido','estupido','hdp','culero','mamón','mamon','pinche',
            'fuck','shit','bitch','asshole','bastard','cunt','dick','faggot','whore','retard',
        ];
        $low = mb_strtolower($text);
        foreach ($list as $word) {
            if (str_contains($low, $word)) return true;
        }
        return false;
    }
}



