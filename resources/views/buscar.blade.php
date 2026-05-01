<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; display: flex; flex-direction: column; min-height: 100vh; }
        .container.search-wrap { flex: 1; }
        .search-navbar { background: #fff; border-bottom: 1px solid #f0e8e8; padding: 1rem 2rem; display: flex; align-items: center; gap: 1rem; }
        .search-navbar .brand { font-weight: 700; color: #624F4F; font-size: 1.2rem; text-decoration: none; }
        .search-navbar .brand span { color: #FFB2B2; }
        .search-wrap { padding: 2rem 0 1rem; }
        .search-card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(98,79,79,.1); padding: 1.5rem 2rem; margin-bottom: 2rem; }
        .search-card h4 { color: #624F4F; font-weight: 600; margin-bottom: 1rem; }
        .form-control, .form-select { border: 1.5px solid #e0d4d4; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: .875rem; }
        .form-control:focus, .form-select:focus { border-color: #5886B8; box-shadow: none; }
        .btn-buscar { background: #5886B8; color: #fff; border: none; border-radius: 8px; padding: .6rem 1.5rem; font-family: 'Poppins', sans-serif; font-weight: 600; }
        .btn-limpiar { background: #624F4F; color: #fff; border: none; border-radius: 8px; padding: .6rem 1.2rem; font-family: 'Poppins', sans-serif; font-weight: 600; }
        .results-title { color: #624F4F; font-weight: 700; margin-bottom: 1.5rem; }
        .book-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 10px rgba(98,79,79,.1); transition: transform .2s, box-shadow .2s; height: 100%; }
        .book-card:hover { transform: translateY(-4px); box-shadow: 0 6px 20px rgba(98,79,79,.15); }
        .book-img-wrap { position: relative; padding-top: 140%; overflow: hidden; background: #FDE6E6; }
        .book-img-wrap img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .book-placeholder { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; color: #FFB2B2; font-size: 3rem; }
        .book-body { padding: .85rem 1rem; }
        .book-title { font-weight: 600; font-size: .875rem; color: #1a1a1a; margin-bottom: .25rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .book-autor { font-size: .78rem; color: #624F4F; margin-bottom: .25rem; }
        .book-price { font-weight: 700; color: #5886B8; font-size: .95rem; margin-bottom: .5rem; }
        .btn-ver { display: block; background: #5886B8; color: #fff; border: none; border-radius: 6px; padding: .4rem; font-family: 'Poppins', sans-serif; font-size: .8rem; font-weight: 600; text-align: center; text-decoration: none; width: 100%; }
        .btn-ver:hover { opacity: .88; color: #fff; }
        .no-results { text-align: center; padding: 3rem 0; color: #888; }
        .no-results i { font-size: 3rem; color: #FFB2B2; display: block; margin-bottom: 1rem; }
        .badge-cat { background: #FDE6E6; color: #624F4F; font-size: .72rem; padding: .2rem .6rem; border-radius: 10px; font-weight: 500; }
    </style>
</head>
<body>

<x-loader />

<nav class="search-navbar">
    <a href="{{ route('home') }}" class="brand">Amate<span>ca</span></a>
    <div class="ms-auto d-flex gap-2">
        @guest
            <a href="{{ route('login') }}" class="btn btn-sm" style="background:#5886B8;color:#fff;border-radius:8px;font-family:'Poppins',sans-serif;font-weight:600;">Iniciar sesión</a>
        @endguest
        @auth
            <a href="{{ route('dashboard') }}" class="btn btn-sm" style="background:#5886B8;color:#fff;border-radius:8px;font-family:'Poppins',sans-serif;font-weight:600;">
                <i class="bi bi-grid"></i> Mi cuenta
            </a>
            @if(Auth::user()->isStaff())
                <a href="{{ route('admin.libros.index') }}" class="btn btn-sm" style="background:#624F4F;color:#fff;border-radius:8px;font-family:'Poppins',sans-serif;font-weight:600;">Panel admin</a>
            @endif
        @endauth
    </div>
</nav>

<div class="container search-wrap">
    <div class="search-card">
        <h4><i class="bi bi-search me-2"></i>Buscar libros</h4>
        <form method="GET" action="{{ route('buscar') }}">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-semibold text-secondary">Título o descripción</label>
                    <input type="text" name="q" class="form-control" placeholder="Ej. Cien años de soledad..." value="{{ $q }}">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-semibold text-secondary">Autor</label>
                    <input type="text" name="autor" class="form-control" placeholder="Nombre del autor..." value="{{ $autorQ }}">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label small fw-semibold text-secondary">Categoría</label>
                    <select name="categoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        @foreach ($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ $categoriaId == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn-buscar flex-grow-1"><i class="bi bi-search"></i> Buscar</button>
                    @if($q || $autorQ || $categoriaId)
                        <a href="{{ route('buscar') }}" class="btn-limpiar"><i class="bi bi-x"></i></a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if($q || $autorQ || $categoriaId)
        <h5 class="results-title">
            {{ $libros->total() }} resultado(s)
            @if($q) para "<strong>{{ $q }}</strong>"@endif
        </h5>
    @endif

    @if($libros->isEmpty())
        <div class="no-results">
            <i class="bi bi-book"></i>
            <p class="fw-semibold">No encontramos libros con esos filtros.</p>
            <p class="small text-muted">Intenta con otros términos o limpia los filtros.</p>
            <a href="{{ route('buscar') }}" class="btn-limpiar mt-2 d-inline-block">Ver todos</a>
        </div>
    @else
        <div class="row g-3 mb-4">
            @foreach ($libros as $libro)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="book-card">
                    <div class="book-img-wrap">
                        @if($libro->imagen_portada)
                            <img src="{{ asset('storage/' . $libro->imagen_portada) }}" alt="{{ $libro->titulo }}">
                        @else
                            <div class="book-placeholder"><i class="bi bi-book-half"></i></div>
                        @endif
                    </div>
                    <div class="book-body">
                        <p class="book-title">{{ $libro->titulo }}</p>
                        <p class="book-autor">{{ $libro->author->nombre ?? '—' }}</p>
                        <span class="badge-cat">{{ $libro->category->nombre ?? '' }}</span>
                        <p class="book-price mt-2">${{ number_format($libro->precio, 2) }}</p>
                        @auth
                            <a href="{{ route('libros.show', $libro) }}" class="btn-ver">Ver más</a>
                        @else
                            <a href="{{ route('login') }}" class="btn-ver">Ver más</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{ $libros->links() }}
    @endif
</div>

<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
