@extends('admin.layout')

@section('title', 'Editar: ' . $categoria->nombre)

@section('content')
<div class="page-header">
    <h1>Editar categoría</h1>
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card" style="max-width:580px;">
    <form method="POST" action="{{ route('admin.categorias.update', $categoria) }}">
        @csrf
        @method('PUT')
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre"
                       value="{{ old('nombre', $categoria->nombre) }}" autofocus>
                @error('nombre') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">
                    Descripción
                    <span style="font-weight:400; color:#888;">(opcional)</span>
                </label>
                <input type="text" id="descripcion" name="descripcion"
                       value="{{ old('descripcion', $categoria->descripcion) }}"
                       placeholder="Breve descripción del género">
                @error('descripcion') <span class="form-error">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Actualizar categoría</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
