@extends('admin.layout')

@section('title', $book->titulo)

@section('content')
<div class="page-header">
    <h1>Detalle del libro</h1>
    <div style="display:flex; gap:.75rem;">
        <a href="{{ route('admin.libros.edit', $book) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">← Volver</a>
    </div>
</div>

<div class="card">
    @if ($book->imagen_portada)
        <div style="margin-bottom:1.75rem;">
            <img src="{{ asset('storage/' . $book->imagen_portada) }}"
                 alt="Portada de {{ $book->titulo }}"
                 style="max-width:160px; border-radius:8px; box-shadow:0 3px 10px rgba(0,0,0,.15);">
        </div>
    @endif

    <div class="detail-grid">

        <div class="detail-item detail-full">
            <label>Título</label>
            <p style="font-size:1.15rem; font-weight:700;">{{ $book->titulo }}</p>
        </div>

        <div class="detail-item">
            <label>ISBN</label>
            <p>{{ $book->ISBN }}</p>
        </div>

        <div class="detail-item">
            <label>Idioma</label>
            <p>{{ $book->idioma }}</p>
        </div>

        <div class="detail-item">
            <label>Precio</label>
            <p style="font-size:1.05rem; font-weight:600; color:#5886B8;">
                ${{ number_format($book->precio, 2) }}
            </p>
        </div>

        <div class="detail-item">
            <label>Stock disponible</label>
            <p>{{ $book->stock }} unidades</p>
        </div>

        <div class="detail-item">
            <label>Autor</label>
            <p>{{ $book->author->nombre ?? '—' }}</p>
        </div>

        <div class="detail-item">
            <label>Categoría</label>
            <p>{{ $book->category->nombre ?? '—' }}</p>
        </div>

        <div class="detail-item">
            <label>Fecha de registro</label>
            <p>{{ $book->fecha_registro?->format('d/m/Y') }}</p>
        </div>

        <div class="detail-item">
            <label>Estado</label>
            <p>
                <span class="badge {{ $book->activo ? 'badge-active' : 'badge-inactive' }}">
                    {{ $book->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </p>
        </div>

        @if($book->descripcion)
        <div class="detail-item detail-full">
            <label>Descripción</label>
            <p style="line-height:1.7;color:#444;">{{ $book->descripcion }}</p>
        </div>
        @endif

    </div>

    <div class="form-actions">
        <form method="POST" action="{{ route('admin.libros.toggle', $book) }}">
            @csrf
            <button type="submit"
                    class="btn {{ $book->activo ? 'btn-toggle-on' : 'btn-toggle-off' }}">
                {{ $book->activo ? 'Desactivar libro' : 'Activar libro' }}
            </button>
        </form>
    </div>
</div>
@endsection
