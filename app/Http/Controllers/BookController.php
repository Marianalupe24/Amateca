<?php


namespace App\Http\Controllers;


use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    public function index()
    {
        $libros = Book::with(['author', 'category'])->orderBy('titulo')->get();
        return view('admin.libros.index', compact('libros'));
    }


    public function create()
    {
        $autores    = Author::orderBy('nombre')->get();
        $categorias = Category::orderBy('nombre')->get();
        return view('admin.libros.create', compact('autores', 'categorias'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'         => 'required|string|max:255',
            'descripcion'    => 'nullable|string',
            'ISBN'           => 'required|string|max:20|unique:libros,ISBN',
            'precio'         => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'idioma'         => 'required|string|max:50',
            'imagen_portada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'fecha_registro' => 'required|date',
            'id_autor'       => 'required|exists:autores,id',
            'id_categoria'   => 'required|exists:categorias,id',
        ], [
            'titulo.required'            => 'El título es obligatorio.',
            'ISBN.required'              => 'El ISBN es obligatorio.',
            'ISBN.unique'                => 'Este ISBN ya está registrado.',
            'precio.required'            => 'El precio es obligatorio.',
            'precio.numeric'             => 'El precio debe ser un número.',
            'precio.min'                 => 'El precio no puede ser negativo.',
            'stock.required'             => 'El stock es obligatorio.',
            'stock.integer'              => 'El stock debe ser un número entero.',
            'stock.min'                  => 'El stock no puede ser negativo.',
            'idioma.required'            => 'El idioma es obligatorio.',
            'imagen_portada.image'       => 'El archivo debe ser una imagen.',
            'imagen_portada.mimes'       => 'Solo se aceptan jpg, jpeg, png y webp.',
            'imagen_portada.max'         => 'La imagen no puede superar 2MB.',
            'fecha_registro.required'    => 'La fecha de registro es obligatoria.',
            'fecha_registro.date'        => 'La fecha no tiene un formato válido.',
            'id_autor.required'          => 'Debe seleccionar un autor.',
            'id_autor.exists'            => 'El autor seleccionado no existe.',
            'id_categoria.required'      => 'Debe seleccionar una categoría.',
            'id_categoria.exists'        => 'La categoría seleccionada no existe.',
        ]);


        if ($request->hasFile('imagen_portada')) {
            $validated['imagen_portada'] = $request->file('imagen_portada')->store('libros', 'public');
        } else {
            unset($validated['imagen_portada']);
        }


        Book::create($validated);


        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro creado exitosamente.');
    }


    public function show(Book $book)
    {
        $book->load(['author', 'category']);
        return view('admin.libros.show', compact('book'));
    }


    public function edit(Book $book)
    {
        $autores    = Author::orderBy('nombre')->get();
        $categorias = Category::orderBy('nombre')->get();
        return view('admin.libros.edit', compact('book', 'autores', 'categorias'));
    }


    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'titulo'         => 'required|string|max:255',
            'descripcion'    => 'nullable|string',
            'ISBN'           => 'required|string|max:20|unique:libros,ISBN,' . $book->id,
            'precio'         => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'idioma'         => 'required|string|max:50',
            'imagen_portada' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'fecha_registro' => 'required|date',
            'id_autor'       => 'required|exists:autores,id',
            'id_categoria'   => 'required|exists:categorias,id',
        ], [
            'titulo.required'            => 'El título es obligatorio.',
            'ISBN.required'              => 'El ISBN es obligatorio.',
            'ISBN.unique'                => 'Este ISBN ya está registrado.',
            'precio.required'            => 'El precio es obligatorio.',
            'precio.numeric'             => 'El precio debe ser un número.',
            'precio.min'                 => 'El precio no puede ser negativo.',
            'stock.required'             => 'El stock es obligatorio.',
            'stock.integer'              => 'El stock debe ser un número entero.',
            'stock.min'                  => 'El stock no puede ser negativo.',
            'idioma.required'            => 'El idioma es obligatorio.',
            'imagen_portada.image'       => 'El archivo debe ser una imagen.',
            'imagen_portada.mimes'       => 'Solo se aceptan jpg, jpeg, png y webp.',
            'imagen_portada.max'         => 'La imagen no puede superar 2MB.',
            'fecha_registro.required'    => 'La fecha de registro es obligatoria.',
            'fecha_registro.date'        => 'La fecha no tiene un formato válido.',
            'id_autor.required'          => 'Debe seleccionar un autor.',
            'id_autor.exists'            => 'El autor seleccionado no existe.',
            'id_categoria.required'      => 'Debe seleccionar una categoría.',
            'id_categoria.exists'        => 'La categoría seleccionada no existe.',
        ]);


        if ($request->hasFile('imagen_portada')) {
            if ($book->imagen_portada) {
                Storage::disk('public')->delete($book->imagen_portada);
            }
            $validated['imagen_portada'] = $request->file('imagen_portada')->store('libros', 'public');
        } else {
            unset($validated['imagen_portada']);
        }


        $book->update($validated);


        return redirect()->route('admin.libros.index')
            ->with('success', 'Libro actualizado exitosamente.');
    }


    public function toggleActivo(Book $book)
    {
        $book->update(['activo' => !$book->activo]);
        $estado = $book->activo ? 'activado' : 'desactivado';
        return back()->with('success', "Libro {$estado} exitosamente.");
    }
}



