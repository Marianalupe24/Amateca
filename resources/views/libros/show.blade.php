<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->titulo }} — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
     <link rel="stylesheet" href="{{ asset('css/showLibros.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
</head>
<body>
<x-loader />
<x-navbar />

<div class="book-detail-wrap">


    <a href="{{ url()->previous() }}" class="back-link mb-3 d-inline-block">
        <i class="bi bi-arrow-left"></i> Volver
    </a>


    @if(session('success'))
        <div class="alert-flash success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-flash error">{{ session('error') }}</div>
    @endif



    <div class="detail-card mb-4">
        <div class="row g-0">
            <div class="col-12 col-md-4 detail-img-col">
                @if($book->imagen_portada)
                    <img src="{{ asset('storage/' . $book->imagen_portada) }}"
                         alt="{{ $book->titulo }}" class="detail-img">
                @else
                    <div class="detail-placeholder"><i class="bi bi-book-half"></i></div>
                @endif
            </div>
            <div class="col-12 col-md-8 detail-body">
                <span class="detail-categoria">{{ $book->category->nombre ?? 'Sin categoría' }}</span>
                <h1 class="detail-title">{{ $book->titulo }}</h1>
                <p class="detail-autor"><i class="bi bi-person-fill me-1"></i>{{ $book->author->nombre ?? '—' }}</p>


                <p class="detail-price">${{ number_format($book->precio, 2) }}</p>
                <p class="detail-stock">
                    @if($book->stock > 0)
                        <i class="bi bi-check-circle-fill text-success"></i> {{ $book->stock }} unidades disponibles
                    @else
                        <i class="bi bi-x-circle-fill text-danger"></i> Sin stock
                    @endif
                </p>


                {{-- Botón añadir al carrito --}}
                <form action="{{ route('carrito.add', $book) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-carrito" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                        <i class="bi bi-bag-plus me-1"></i>
                        {{ $book->stock > 0 ? 'Añadir al carrito' : 'Sin stock' }}
                    </button>
                </form>


                <div class="detail-meta">
                    <p class="detail-meta-item"><strong>ISBN:</strong> {{ $book->ISBN }}</p>
                    <p class="detail-meta-item"><strong>Idioma:</strong> {{ $book->idioma }}</p>
                    <p class="detail-meta-item"><strong>Registro:</strong> {{ $book->fecha_registro?->format('d/m/Y') }}</p>
                </div>


                @if($book->descripcion)
                    <div class="desc-section">
                        <h6>Descripción</h6>
                        <p class="desc-text">{{ $book->descripcion }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>



    <div class="mb-4">
        <p class="section-title"><i class="bi bi-chat-dots me-1"></i>Comentarios ({{ $book->comments->count() }})</p>


        @if(!$userComment)
            <div class="form-comment mb-4">
                <form action="{{ route('comentarios.store', $book) }}" method="POST">
                    @csrf
                    <textarea name="comentario" rows="3"
                              placeholder="Escribe tu comentario (10-500 caracteres)...">{{ old('comentario') }}</textarea>
                    @error('comentario')
                        <p style="color:#c0392b; font-size:.78rem; margin-top:.25rem;">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="btn-comentar mt-2">Publicar comentario</button>
                </form>
            </div>
        @else
            <div class="alert-flash success mb-3">Ya dejaste un comentario en este libro.</div>
        @endif


        @forelse($book->comments as $comentario)
            <div class="comment-card">
                <div class="d-flex justify-content-between align-items-start">
                    <span class="comment-user">
                        <i class="bi bi-person-circle me-1"></i>
                        {{ $comentario->user->name ?? 'Usuario' }}
                        {{ $comentario->user->apellido ?? '' }}
                    </span>
                    <span class="comment-date">{{ $comentario->fecha?->format('d/m/Y') }}</span>
                </div>
                <p class="comment-text">{{ $comentario->comentario }}</p>
            </div>
        @empty
            <p class="text-muted small">Sé el primero en comentar este libro.</p>
        @endforelse
    </div>
</div>


<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



