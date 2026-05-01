@extends('admin.layout')

@section('title', 'Autores')

@section('content')
<div class="page-header">
    <h1>Autores</h1>
    <a href="{{ route('admin.autores.create') }}" class="btn btn-primary">+ Nuevo autor</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Nacionalidad</th>
                    <th>Libros</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td><strong>{{ $autor->nombre }}</strong></td>
                    <td>{{ $autor->nacionalidad ?? '—' }}</td>
                    <td>
                        @if ($autor->books_count > 0)
                            <span class="badge badge-active">{{ $autor->books_count }}</span>
                        @else
                            <span style="color:#aaa;">0</span>
                        @endif
                    </td>
                    <td>
                        <div class="td-actions">
                            <a href="{{ route('admin.autores.edit', $autor) }}"
                               class="btn btn-sm btn-primary">Editar</a>

                            <form method="POST"
                                  action="{{ route('admin.autores.destroy', $autor) }}"
                                  data-msg="¿Eliminar a {{ $autor->nombre }}? Esta acción no se puede deshacer."
                                  onsubmit="return confirm(this.dataset.msg)">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        @if($autor->books_count > 0)
                                            disabled
                                            title="Tiene {{ $autor->books_count }} libro(s) asociado(s)"
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
                        No hay autores registrados.
                        <a href="{{ route('admin.autores.create') }}" style="color:#5886B8;">Agregar el primero</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
