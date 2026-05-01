@extends('admin.layout')

@section('title', 'Comentarios')

@section('content')
<div class="page-header">
    <h1>Gestión de comentarios</h1>
</div>

{{-- Filtros --}}
<div class="card" style="margin-bottom:1.25rem;">
    <form method="GET" action="{{ route('admin.comentarios.index') }}">
        <div style="display:flex;gap:1rem;flex-wrap:wrap;align-items:flex-end;">
            <div class="form-group" style="flex:1;min-width:180px;">
                <label>Filtrar por libro</label>
                <input type="text" name="libro" value="{{ request('libro') }}" placeholder="Título del libro...">
            </div>
            <div class="form-group" style="flex:1;min-width:180px;">
                <label>Filtrar por usuario</label>
                <input type="text" name="usuario" value="{{ request('usuario') }}" placeholder="Nombre del usuario...">
            </div>
            <div style="display:flex;gap:.75rem;">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                @if(request('libro') || request('usuario'))
                    <a href="{{ route('admin.comentarios.index') }}" class="btn btn-secondary">Limpiar</a>
                @endif
            </div>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comentarios as $comentario)
                <tr>
                    <td>{{ $comentario->id }}</td>
                    <td>
                        {{ $comentario->user->name ?? '—' }}
                        {{ $comentario->user->apellido ?? '' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.libros.show', $comentario->id_libro) }}"
                           style="color:#5886B8;text-decoration:none;">
                            {{ Str::limit($comentario->book->titulo ?? '—', 30) }}
                        </a>
                    </td>
                    <td style="max-width:280px;white-space:normal;">
                        {{ Str::limit($comentario->comentario, 80) }}
                    </td>
                    <td>{{ $comentario->fecha?->format('d/m/Y') }}</td>
                    <td>
                        <form method="POST"
                              action="{{ route('admin.comentarios.destroy', $comentario) }}"
                              data-msg="¿Eliminar este comentario? Esta acción no se puede deshacer."
                              onsubmit="return confirm(this.dataset.msg)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#888;padding:2rem 0;">
                        No hay comentarios que coincidan con los filtros.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1rem;">
        {{ $comentarios->withQueryString()->links() }}
    </div>
</div>
@endsection
