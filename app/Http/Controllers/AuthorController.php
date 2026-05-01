<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $autores = Author::withCount('books')->orderBy('nombre')->get();
        return view('admin.autores.index', compact('autores'));
    }

    public function create()
    {
        return view('admin.autores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'       => 'required|string|max:255',
            'nacionalidad' => 'nullable|string|max:100',
        ], [
            'nombre.required' => 'El nombre del autor es obligatorio.',
        ]);

        Author::create($validated);

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor creado exitosamente.');
    }

    public function edit(Author $autor)
    {
        return view('admin.autores.edit', compact('autor'));
    }

    public function update(Request $request, Author $autor)
    {
        $validated = $request->validate([
            'nombre'       => 'required|string|max:255',
            'nacionalidad' => 'nullable|string|max:100',
        ], [
            'nombre.required' => 'El nombre del autor es obligatorio.',
        ]);

        $autor->update($validated);

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor actualizado exitosamente.');
    }

    public function destroy(Author $autor)
    {
        if ($autor->books()->exists()) {
            return back()->with('error',
                "No se puede eliminar a \"{$autor->nombre}\" porque tiene libros asociados.");
        }

        $autor->delete();

        return redirect()->route('admin.autores.index')
            ->with('success', 'Autor eliminado exitosamente.');
    }
}
