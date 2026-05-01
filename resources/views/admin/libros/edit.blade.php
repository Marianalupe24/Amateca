@extends('admin.layout')

@section('title', 'Editar: ' . $book->titulo)

@section('content')
<div class="page-header">
    <h1>Editar libro</h1>
    <div style="display:flex; gap:.75rem;">
        <a href="{{ route('admin.libros.show', $book) }}" class="btn btn-secondary">Ver detalle</a>
        <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">← Volver</a>
    </div>
</div>

<div class="card">
    <form method="POST" action="{{ route('admin.libros.update', $book) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-grid">

            <div class="form-group form-full">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo"
                       value="{{ old('titulo', $book->titulo) }}">
                @error('titulo') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group form-full">
                <label for="descripcion">Descripción <span style="font-weight:400;color:#888;">(opcional)</span></label>
                <textarea id="descripcion" name="descripcion" rows="3"
                          style="padding:.6rem .9rem;border:1.5px solid #e0d4d4;border-radius:8px;font-family:'Poppins',sans-serif;font-size:.875rem;resize:vertical;outline:none;transition:border-color .2s;"
                          onfocus="this.style.borderColor='#5886B8'" onblur="this.style.borderColor='#e0d4d4'"
                          >{{ old('descripcion', $book->descripcion) }}</textarea>
                @error('descripcion') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input type="text" id="ISBN" name="ISBN"
                       value="{{ old('ISBN', $book->ISBN) }}" maxlength="20">
                @error('ISBN') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="idioma">Idioma</label>
                <input type="text" id="idioma" name="idioma"
                       value="{{ old('idioma', $book->idioma) }}">
                @error('idioma') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="precio">Precio ($)</label>
                <input type="number" id="precio" name="precio"
                       value="{{ old('precio', $book->precio) }}" step="0.01" min="0">
                @error('precio') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock"
                       value="{{ old('stock', $book->stock) }}" min="0">
                @error('stock') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="id_autor">Autor</label>
                <select id="id_autor" name="id_autor">
                    <option value="">— Seleccionar autor —</option>
                    @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}"
                            {{ old('id_autor', $book->id_autor) == $autor->id ? 'selected' : '' }}>
                            {{ $autor->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('id_autor') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoría</label>
                <select id="id_categoria" name="id_categoria">
                    <option value="">— Seleccionar categoría —</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ old('id_categoria', $book->id_categoria) == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('id_categoria') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fecha_registro">Fecha de registro</label>
                <input type="date" id="fecha_registro" name="fecha_registro"
                       value="{{ old('fecha_registro', $book->fecha_registro?->format('Y-m-d')) }}">
                @error('fecha_registro') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group form-full">
                <label for="imagen_portada">
                    Imagen de portada
                    <span style="font-weight:400; color:#888;">(opcional — deja vacío para conservar la actual)</span>
                </label>
                @if($book->imagen_portada)
                    <div style="margin-bottom:.75rem;">
                        <img src="{{ asset('storage/' . $book->imagen_portada) }}"
                             alt="Portada actual"
                             style="max-width:100px; border-radius:6px; box-shadow:0 2px 8px rgba(0,0,0,.15);">
                        <p style="font-size:.78rem;color:#888;margin-top:.35rem;">Portada actual</p>
                    </div>
                @endif
                <input type="file" id="imagen_portada" name="imagen_portada"
                       accept="image/jpeg,image/png,image/webp">
                @error('imagen_portada') <span class="form-error">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Actualizar libro</button>
            <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
