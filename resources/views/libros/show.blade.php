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
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; display: flex; flex-direction: column; min-height: 100vh; }
        .book-detail-wrap { max-width: 960px; margin: 2.5rem auto; padding: 0 1.5rem; flex: 1; }
        .back-link { color: #624F4F; font-size: .875rem; text-decoration: none; font-weight: 500; }
        .back-link:hover { color: #5886B8; }
        .detail-card { background: #fff; border-radius: 16px; box-shadow: 0 3px 16px rgba(98,79,79,.1); overflow: hidden; }
        .detail-img-col { background: #FDE6E6; min-height: 340px; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .detail-img { max-width: 220px; width: 100%; border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,.2); }
        .detail-placeholder { font-size: 6rem; color: #FFB2B2; }
        .detail-body { padding: 2rem 2.5rem; }
        .detail-categoria { background: #FDE6E6; color: #624F4F; font-size: .78rem; font-weight: 600; padding: .25rem .75rem; border-radius: 20px; display: inline-block; margin-bottom: .75rem; }
        .detail-title { font-size: 1.6rem; font-weight: 700; color: #1a1a1a; margin-bottom: .35rem; }
        .detail-autor { color: #624F4F; font-weight: 500; font-size: .95rem; margin-bottom: 1rem; }
        .detail-price { font-size: 1.8rem; font-weight: 700; color: #5886B8; margin-bottom: .5rem; }
        .detail-stock { font-size: .875rem; color: #555; margin-bottom: 1.25rem; }
        .btn-carrito { background: #5886B8; color: #fff; border: none; border-radius: 10px; padding: .75rem 2rem; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1rem; transition: opacity .2s; }
        .btn-carrito:hover { opacity: .88; }
        .btn-carrito:disabled { background: #c0c0c0; cursor: not-allowed; }
        .detail-meta { margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #f0e8e8; }
        .detail-meta-item { font-size: .875rem; color: #555; margin-bottom: .35rem; }
        .detail-meta-item strong { color: #624F4F; }
        .desc-section { margin-top: 1.5rem; }
        .desc-section h6 { color: #624F4F; font-weight: 700; margin-bottom: .5rem; }
        .desc-text { font-size: .9rem; color: #444; line-height: 1.7; }
        /* Stars */
        .stars-wrap { display: flex; gap: .15rem; align-items: center; }
        .star { color: #FFB2B2; font-size: 1.1rem; }
        .star.filled { color: #f5a623; }
        .avg-label { font-size: .85rem; color: #888; margin-left: .5rem; }
        /* Comments section */
        .section-title { font-weight: 700; color: #624F4F; font-size: 1.1rem; margin-bottom: 1.25rem; border-bottom: 2px solid #FDE6E6; padding-bottom: .5rem; }
        .comment-card { background: #fff; border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1rem; box-shadow: 0 1px 6px rgba(98,79,79,.08); }
        .comment-user { font-weight: 600; font-size: .875rem; color: #624F4F; }
        .comment-date { font-size: .75rem; color: #aaa; }
        .comment-text { font-size: .875rem; color: #333; margin-top: .4rem; line-height: 1.6; }
        .form-comment textarea { border: 1.5px solid #e0d4d4; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: .875rem; width: 100%; padding: .75rem 1rem; resize: vertical; outline: none; }
        .form-comment textarea:focus { border-color: #5886B8; }
        .btn-comentar { background: #5886B8; color: #fff; border: none; border-radius: 8px; padding: .55rem 1.5rem; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: .875rem; }
        .rating-stars-input { display: flex; gap: .3rem; margin-bottom: .75rem; }
        .rating-stars-input input { display: none; }
        .rating-stars-input label { font-size: 1.5rem; color: #e0d4d4; cursor: pointer; transition: color .15s; }
        .rating-stars-input label:hover,
        .rating-stars-input label:hover ~ label,
        .rating-stars-input input:checked ~ label { color: #f5a623; }
        .alert-flash { border-radius: 8px; padding: .75rem 1rem; margin-bottom: 1rem; font-size: .875rem; font-weight: 500; }
        .alert-flash.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-flash.error   { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }
    </style>
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


    {{-- ── DETALLE PRINCIPAL ── --}}
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


                {{-- Calificación promedio --}}
                @if($book->ratings->isNotEmpty())
                    <div class="d-flex align-items-center mb-3">
                        <div class="stars-wrap">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star-fill star {{ $i <= round($avgRating) ? 'filled' : '' }}"></i>
                            @endfor
                        </div>
                        <span class="avg-label">{{ number_format($avgRating, 1) }} ({{ $book->ratings->count() }} calificación(es))</span>
                    </div>
                @endif


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


    {{-- ── CALIFICACIÓN ── --}}
    <div class="mb-4">
        <p class="section-title"><i class="bi bi-star me-1"></i>Calificación</p>
        @if($hasPurchased)
            <form action="{{ route('calificaciones.store', $book) }}" method="POST">
                @csrf
                <div class="rating-stars-input flex-row-reverse">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="estrellas" id="star{{ $i }}" value="{{ $i }}"
                               {{ ($userRating && $userRating->estrellas == $i) ? 'checked' : '' }}>
                        <label for="star{{ $i }}"><i class="bi bi-star-fill"></i></label>
                    @endfor
                </div>
                <button type="submit" class="btn-comentar">Guardar calificación</button>
            </form>
        @else
            <p class="text-muted small"><i class="bi bi-lock me-1"></i>Solo usuarios que han comprado este libro pueden calificarlo.</p>
        @endif
    </div>


    {{-- ── COMENTARIOS ── --}}
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



