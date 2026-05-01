@extends('admin.layout')

@section('title', 'Nuevo autor')

@section('content')
<div class="page-header">
    <h1>Nuevo autor</h1>
    <a href="{{ route('admin.autores.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card" style="max-width:580px;">
    <form method="POST" action="{{ route('admin.autores.store') }}">
        @csrf
        <div class="form-grid" style="grid-template-columns:1fr;">

            <div class="form-group">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre"
                       value="{{ old('nombre') }}"
                       placeholder="Nombre del autor" autofocus>
                @error('nombre') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="nacionalidad">
                    Nacionalidad
                    <span style="font-weight:400; color:#888;">(opcional)</span>
                </label>
                <input type="text" id="nacionalidad" name="nacionalidad"
                       value="{{ old('nacionalidad') }}"
                       placeholder="Ej. Colombiano">
                @error('nacionalidad') <span class="form-error">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar autor</button>
            <a href="{{ route('admin.autores.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
