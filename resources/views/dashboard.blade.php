<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amateca - Inicio</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
</head>
<body>
    <x-loader />
<x-navbar />
<div style="flex:1;">
    {{-- ============================================================
         HERO BANNER
    ============================================================ --}}
    <section class="dash-hero">
        <div class="dash-hero-content">
            <p class="dash-hero-eyebrow">Bienvenido, {{ Auth::user()->name }}</p>
            <h1 class="dash-hero-title">
                <em>Cultiva</em> tu pasión<br>por la lectura.
            </h1>
            <a href="#recien" class="dash-hero-btn">Explora nuevos libros</a>
        </div>
        <div class="dash-hero-img-wrap">
            <div class="dash-hero-oval"></div>
            <img src="{{ asset('img/libros-stack.png') }}" alt="Libros" class="dash-hero-img"
                 onerror="this.style.display='none'">
        </div>
    </section>

    {{-- ============================================================
         FEATURES BAR
    ============================================================ --}}
    <div class="dash-features-bar">
        <div class="dash-feature">
            <i class="bi bi-search-heart"></i>
            <div>
                <p class="dash-feature-title">Búsqueda Inteligente</p>
            </div>
        </div>
        <div class="dash-feature-divider"></div>
        <div class="dash-feature">
            <i class="bi bi-star-half"></i>
            <div>
                <p class="dash-feature-title">Reseñas Reales</p>
            </div>
        </div>
        <div class="dash-feature-divider"></div>
        <div class="dash-feature">
            <i class="bi bi-shield-check"></i>
            <div>
                <p class="dash-feature-title">Pago Rápido<br>y Seguro</p>
            </div>
        </div>
    </div>


    {{-- ============================================================
         SECCIÓN: CATÁLOGO DE LIBROS
    ============================================================ --}}
    <section class="dash-section" id="recien">
        <div class="container">
            <div class="dash-section-header">
                <h2 class="dash-section-title">Catálogo de libros</h2>
                <a href="{{ route('buscar') }}" class="dash-see-all">Ver todos <i class="bi bi-chevron-right"></i></a>
            </div>


            <div class="row g-3">
                @forelse($libros as $libro)
                <div class="col-6 col-sm-4 col-md-3">
                    <a href="{{ route('libros.show', $libro) }}" style="text-decoration:none;color:inherit;">
                        <div class="dash-book-card">
                            <div class="dash-book-img-wrap">
                                @if($libro->imagen_portada)
                                    <img src="{{ asset('storage/' . $libro->imagen_portada) }}"
                                         alt="{{ $libro->titulo }}" class="dash-book-img">
                                @else
                                    <div class="dash-book-img" style="background:#FDE6E6;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-book-half" style="font-size:2.5rem;color:#FFB2B2;"></i>
                                    </div>
                                @endif
                                <div class="dash-book-overlay">
                                    <i class="bi bi-eye-fill"></i>
                                    <span>Ver detalle</span>
                                </div>
                            </div>
                            <div class="dash-book-info">
                                <p class="dash-book-title">{{ Str::limit($libro->titulo, 30) }}</p>
                                <p class="dash-book-price">${{ number_format($libro->precio, 2) }}</p>
                                <p class="dash-book-autor">{{ $libro->author->nombre ?? '—' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-book" style="font-size:3rem;display:block;margin-bottom:.75rem;"></i>
                    No hay libros disponibles aún.
                </div>
                @endforelse
            </div>


            <div style="margin-top:1.5rem;">
                {{ $libros->links() }}
            </div>
        </div>
    </section>


    {{-- ============================================================
         SECCIÓN: RECOMENDADOS PARA TI
    ============================================================ --}}
    @if($recomendaciones->isNotEmpty())
    <section class="dash-section" id="recomendados">
        <div class="container">
            <div class="dash-section-header">
                <h2 class="dash-section-title">Recomendados para ti</h2>
            </div>


            <div class="row g-3">
                @foreach($recomendaciones as $libro)
                <div class="col-6 col-sm-4 col-md-3">
                    <a href="{{ route('libros.show', $libro) }}" style="text-decoration:none;color:inherit;">
                        <div class="dash-book-card">
                            <div class="dash-book-img-wrap">
                                @if($libro->imagen_portada)
                                    <img src="{{ asset('storage/' . $libro->imagen_portada) }}"
                                         alt="{{ $libro->titulo }}" class="dash-book-img">
                                @else
                                    <div class="dash-book-img" style="background:#FDE6E6;display:flex;align-items:center;justify-content:center;">
                                        <i class="bi bi-book-half" style="font-size:2.5rem;color:#FFB2B2;"></i>
                                    </div>
                                @endif
                                <div class="dash-book-overlay">
                                    <i class="bi bi-eye-fill"></i>
                                    <span>Ver detalle</span>
                                </div>
                            </div>
                            <div class="dash-book-info">
                                <p class="dash-book-title">{{ Str::limit($libro->titulo, 30) }}</p>
                                <p class="dash-book-price">${{ number_format($libro->precio, 2) }}</p>
                                <p class="dash-book-autor">{{ $libro->author->nombre ?? '—' }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>
    <x-footer />


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        /* ── Navbar sombra al scroll ── */
        const nav = document.getElementById('dashNav');
        if (nav) {
            window.addEventListener('scroll', () => {
                nav.classList.toggle('scrolled', window.scrollY > 20);
            }, { passive: true });
        }


        /* ── Avatar dropdown ── */
        const avatarBtn      = document.getElementById('avatarBtn');
        const avatarDropdown = document.getElementById('avatarDropdown');
        if (avatarBtn) {
            avatarBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                avatarDropdown.classList.toggle('open');
            });
            document.addEventListener('click', () => avatarDropdown.classList.remove('open'));
        }
    });
    </script>


</body>
</html>

