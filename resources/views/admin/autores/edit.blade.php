@extends('admin.layout')

@section('title', 'Editar: ' . $autor->nombre)

@section('content')
<div class="page-header">
    <h1>Editar autor</h1>
    <a href="{{ route('admin.autores.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card" style="max-width:580px;">
    <form method="POST" action="{{ route('admin.autores.update', $autor) }}">
        @csrf
        @method('PUT')
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre"
                       value="{{ old('nombre', $autor->nombre) }}" autofocus>
                @error('nombre') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="nacionalidad">
                    Nacionalidad
                    <span style="font-weight:400; color:#888;">(opcional)</span>
                </label>
                <input type="text" id="nacionalidad" name="nacionalidad"
                       value="{{ old('nacionalidad', $autor->nacionalidad) }}"
                       placeholder="Ej. Colombiano">
                @error('nacionalidad') <span class="form-error">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Actualizar autor</button>
            <a href="{{ route('admin.autores.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
