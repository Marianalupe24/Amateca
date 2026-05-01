@extends('admin.layout')

@section('title', 'Nuevo libro')

@section('content')
<div class="page-header">
    <h1>Nuevo libro</h1>
    <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">← Volver</a>
</div>

<div class="card">
    <form method="POST" action="{{ route('admin.libros.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-grid">

            <div class="form-group form-full">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo"
                       value="{{ old('titulo') }}" placeholder="Título del libro">
                @error('titulo') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group form-full">
                <label for="descripcion">Descripción <span style="font-weight:400;color:#888;">(opcional)</span></label>
                <textarea id="descripcion" name="descripcion" rows="3"
                          style="padding:.6rem .9rem;border:1.5px solid #e0d4d4;border-radius:8px;font-family:'Poppins',sans-serif;font-size:.875rem;resize:vertical;outline:none;transition:border-color .2s;"
                          onfocus="this.style.borderColor='#5886B8'" onblur="this.style.borderColor='#e0d4d4'"
                          placeholder="Breve descripción del libro...">{{ old('descripcion') }}</textarea>
                @error('descripcion') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="ISBN">ISBN</label>
                <input type="text" id="ISBN" name="ISBN"
                       value="{{ old('ISBN') }}" placeholder="978-0-000-00000-0" maxlength="20">
                @error('ISBN') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="idioma">Idioma</label>
                <input type="text" id="idioma" name="idioma"
                       value="{{ old('idioma') }}" placeholder="Español">
                @error('idioma') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="precio">Precio ($)</label>
                <input type="number" id="precio" name="precio"
                       value="{{ old('precio') }}" step="0.01" min="0" placeholder="0.00">
                @error('precio') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="stock">Stock inicial</label>
                <input type="number" id="stock" name="stock"
                       value="{{ old('stock', 0) }}" min="0">
                @error('stock') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="id_autor">Autor</label>
                <select id="id_autor" name="id_autor">
                    <option value="">— Seleccionar autor —</option>
                    @foreach ($autores as $autor)
                        <option value="{{ $autor->id }}"
                            {{ old('id_autor') == $autor->id ? 'selected' : '' }}>
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
                            {{ old('id_categoria') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('id_categoria') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="fecha_registro">Fecha de registro</label>
                <input type="date" id="fecha_registro" name="fecha_registro"
                       value="{{ old('fecha_registro', date('Y-m-d')) }}">
                @error('fecha_registro') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group form-full">
                <label for="imagen_portada">
                    Imagen de portada
                    <span style="font-weight:400; color:#888;">(opcional — JPG, PNG o WEBP, máx. 2 MB)</span>
                </label>
                <input type="file" id="imagen_portada" name="imagen_portada"
                       accept="image/jpeg,image/png,image/webp">
                @error('imagen_portada') <span class="form-error">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar libro</button>
            <a href="{{ route('admin.libros.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
