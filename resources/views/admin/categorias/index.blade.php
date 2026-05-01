@extends('admin.layout')

@section('title', 'Categorías')

@section('content')
<div class="page-header">
    <h1>Categorías</h1>
    <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">+ Nueva categoría</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Libros</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td><strong>{{ $categoria->nombre }}</strong></td>
                    <td style="color:#555;">{{ $categoria->descripcion ?? '—' }}</td>
                    <td>
                        @if ($categoria->books_count > 0)
                            <span class="badge badge-active">{{ $categoria->books_count }}</span>
                        @else
                            <span style="color:#aaa;">0</span>
                        @endif
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.categorias.edit', $categoria) }}"
                               class="btn btn-sm btn-primary">Editar</a>

                            <form method="POST"
                                  action="{{ route('admin.categorias.destroy', $categoria) }}"
                                  data-msg="¿Eliminar la categoría {{ $categoria->nombre }}? Esta acción no se puede deshacer."
                                  onsubmit="return confirm(this.dataset.msg)">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        @if($categoria->books_count > 0)
                                            disabled
                                            title="Tiene {{ $categoria->books_count }} libro(s) asociado(s)"
                                        @endif>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#888; padding:2.5rem 0;">
                        No hay categorías registradas.
                        <a href="{{ route('admin.categorias.create') }}" style="color:#5886B8;">Agregar la primera</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
