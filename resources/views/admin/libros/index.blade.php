@extends('admin.layout')

@section('title', 'Catálogo de libros')

@section('content')
<div class="page-header">
    <h1>Catálogo de libros</h1>
    <a href="{{ route('admin.libros.create') }}" class="btn btn-primary">+ Nuevo libro</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>ISBN</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($libros as $libro)
                <tr>
                    <td>{{ $libro->id }}</td>
                    <td><strong>{{ $libro->titulo }}</strong></td>
                    <td style="color:#624F4F;">{{ $libro->ISBN }}</td>
                    <td>{{ $libro->author->nombre ?? '—' }}</td>
                    <td>{{ $libro->category->nombre ?? '—' }}</td>
                    <td>${{ number_format($libro->precio, 2) }}</td>
                    <td>{{ $libro->stock }}</td>
                    <td>
                        <span class="badge {{ $libro->activo ? 'badge-active' : 'badge-inactive' }}">
                            {{ $libro->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.libros.show', $libro) }}" class="btn btn-sm btn-secondary">Ver</a>
                            <a href="{{ route('admin.libros.edit', $libro) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form method="POST" action="{{ route('admin.libros.toggle', $libro) }}">
                                @csrf
                                <button type="submit"
                                        class="btn btn-sm {{ $libro->activo ? 'btn-toggle-on' : 'btn-toggle-off' }}">
                                    {{ $libro->activo ? 'Desactivar' : 'Activar' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="text-align:center; color:#888; padding:2.5rem 0;">
                        No hay libros registrados todavía.
                        <a href="{{ route('admin.libros.create') }}" style="color:#5886B8;">Agregar el primero</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
