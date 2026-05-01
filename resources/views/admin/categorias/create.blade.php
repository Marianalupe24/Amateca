@extends('admin.layout')

@section('title', 'Nueva categoría')

@section('content')
<div class="page-header">
    <h1>Nueva categoría</h1>
    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card" style="max-width:580px;">
    <form method="POST" action="{{ route('admin.categorias.store') }}">
        @csrf
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre"
                       value="{{ old('nombre') }}"
                       placeholder="Nombre de la categoría" autofocus>
                @error('nombre') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">
                    Descripción
                    <span style="font-weight:400; color:#888;">(opcional)</span>
                </label>
                <input type="text" id="descripcion" name="descripcion"
                       value="{{ old('descripcion') }}"
                       placeholder="Breve descripción del género">
                @error('descripcion') <span class="form-error">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar categoría</button>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
