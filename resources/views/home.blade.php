<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amateca - Tu próxima aventura comienza aquí</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Fonts: Italiana + Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

{{-- ============================================================
     NAVBAR
============================================================ --}}
<nav class="navbar navbar-light bg-white px-4 py-3">
    <a class="navbar-brand d-flex flex-column align-items-center" href="#">
        {{-- ESPACIO PARA LOGO --}}
        <div class="logo-placeholder">
             <img src="{{ asset('img/logoSinFondo.png') }}" alt="Logo Amateca">
        </div>
        <span class="brand-name">AMATECA</span>
    </a>
    <div class="ms-auto d-flex gap-3">
        <a href="{{ route('register') }}" class="btn btn-hero">Crear cuenta</a>
        <a href="{{ route('login') }}" class="btn btn-hero">Iniciar Sesión</a>
    </div>
</nav>

{{-- ============================================================
     HERO SECTION
============================================================ --}}
<section class="hero-section">
    <div class="container-fluid">
        <div class="row align-items-center min-vh-80">
            {{-- Texto izquierda --}}
            <div class="col-md-6 hero-text ps-5">
                <h1 class="hero-title">
                    <span class="font-italiana fst-italic">Tu próxima</span><br>
                    aventura<br>
                    comienza aquí..
                </h1>
                <a href="#libros" class="btn btn-hero mt-4">Comencemos</a>
            </div>

            {{-- Imagen derecha con fondo oval rosa --}}
            <div class="col-md-6 hero-image-col d-flex justify-content-center align-items-center">
                <div class="hero-oval-bg"></div>
                {{-- ESPACIO PARA IMAGEN HERO (libro con flores) --}}
                <div class="hero-img-placeholder">
                    <img src="{{ asset('img/libro.png') }}" alt="Libro con flores" class="book-img">
                </div>
            </div>
        </div>
    </div>

    {{-- Divisor de olas inferior --}}
    <div class="wave-divider wave-bottom-white"></div>
</section>

{{-- ============================================================
     SECCIÓN: MILES DE HISTORIAS - CARRUSEL
============================================================ --}}
<section class="carousel-section py-5" id="libros">
    <div class="wave-divider wave-top-pink"></div>

    <div class="container text-center">
        <h2 class="section-title font-italiana mb-5">Miles de historias te están esperando</h2>

        {{-- Carrusel de libros 3D --}}
        <div class="book-carousel-wrapper position-relative">
            <button class="carousel-arrow arrow-left" id="prevBtn">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="book-carousel" id="bookCarousel">
                <div class="book-item" data-index="0">
                    {{-- ESPACIO IMAGEN LIBRO 1 --}}
                    <img src="https://covers.openlibrary.org/b/id/10909258-L.jpg" alt="Libro 1" class="book-cover">
                </div>
                <div class="book-item" data-index="1">
                    <img src="https://covers.openlibrary.org/b/id/12547305-L.jpg" alt="Libro 2" class="book-cover">
                </div>
                <div class="book-item active" data-index="2">
                    <img src="https://covers.openlibrary.org/b/id/10909258-L.jpg" alt="Libro 3" class="book-cover">
                </div>
                <div class="book-item" data-index="3">
                    <img src="https://covers.openlibrary.org/b/id/8739161-L.jpg" alt="Libro 4" class="book-cover">
                </div>
                <div class="book-item" data-index="4">
                    <img src="https://covers.openlibrary.org/b/id/10521270-L.jpg" alt="Libro 5" class="book-cover">
                </div>
            </div>

            <button class="carousel-arrow arrow-right" id="nextBtn">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <p class="subtitle-text mt-5">Encuentra exactamente lo que buscas… y más.</p>
    </div>
</section>

{{-- ============================================================
     SECCIÓN: PROMOCIONES
============================================================ --}}
<section class="promo-section py-5">
    <div class="container">
        <h2 class="section-title font-italiana text-center mb-5">Promociones pensadas para ti</h2>

        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="promo-card d-flex align-items-start gap-4">
                    <div class="promo-oval-bg"></div>
                    <div class="promo-text ps-3">
                        <p class="promo-desc">
                            Hasta 20% de descuento en títulos de Fantasía<br>
                            durante todo el mes de Mayo
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="discount-badge">
                    <span class="discount-number">20</span><span class="discount-percent">%</span>
                </div>
            </div>
        </div>

        {{-- ESPACIO PARA IMAGEN LIBROS (fila de libros) --}}
        <div class="books-row-placeholder mt-4">
            <img src="{{ asset('images/books-row.png') }}" alt="Fila de libros" class="books-row-img">
        </div>
    </div>
</section>

{{-- ============================================================
     SECCIÓN: CATEGORÍAS
============================================================ --}}
<section class="categories-section py-5">
    <div class="container">
        <h2 class="section-title font-italiana text-center mb-5">Explora nuestras categorías</h2>

        <div class="row g-4 justify-content-center">
            @php
                $categorias = [
                    ['nombre' => 'Terror',      'img' => 'cat-terror.jpg'],
                    ['nombre' => 'Romance',     'img' => 'cat-romance.jpg'],
                    ['nombre' => 'Fantasía',    'img' => 'cat-fantasia.jpg'],
                    ['nombre' => 'Espiritual',  'img' => 'cat-espiritual.jpg'],
                    ['nombre' => 'Política',    'img' => 'cat-politica.jpg'],
                    ['nombre' => 'Autoayuda',   'img' => 'cat-autoayuda.jpg'],
                    ['nombre' => 'Infantil',    'img' => 'cat-infantil.jpg'],
                    ['nombre' => 'Adulto-Joven','img' => 'cat-adultojoven.jpg'],
                ];
            @endphp

            @foreach($categorias as $cat)
            <div class="col-6 col-md-3">
                <a href="#" class="category-card">
                    {{-- ESPACIO PARA IMAGEN DE CATEGORÍA --}}
                    <div class="cat-img-placeholder">
                        <img src="{{ asset('images/categorias/' . $cat['img']) }}"
                             alt="{{ $cat['nombre'] }}"
                             class="cat-img"
                             onerror="this.style.display='none'">
                    </div>
                    <span class="cat-name">{{ $cat['nombre'] }}</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="wave-divider wave-bottom-pink mt-5"></div>
</section>

{{-- ============================================================
     SECCIÓN: MÁS POPULARES
============================================================ --}}
<section class="populares-section py-5">
    <div class="wave-divider wave-top-pink-light"></div>

    <div class="container">
        <div class="d-flex align-items-center mb-4">
            <h3 class="populares-title me-2">Más populares</h3>
            <i class="bi bi-chevron-right"></i>
        </div>

        <div class="row g-3">
            @php
                $populares = [
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                    ['titulo' => 'Título del Libro', 'precio' => '$0', 'autor' => 'Autor'],
                ];
            @endphp

            @foreach($populares as $libro)
            <div class="col-6 col-md-3">
                <div class="book-card">
                    {{-- ESPACIO PARA IMAGEN DE LIBRO --}}
                    <div class="book-card-img-placeholder">
                        <img src="{{ asset('images/libros/libro-placeholder.jpg') }}"
                             alt="{{ $libro['titulo'] }}"
                             class="book-card-img"
                             onerror="this.style.display='none'">
                        <div class="img-placeholder-icon">
                            <i class="bi bi-image"></i>
                        </div>
                    </div>
                    <div class="book-card-body">
                        <p class="book-card-title">{{ $libro['titulo'] }}</p>
                        <p class="book-card-price">{{ $libro['precio'] }}</p>
                        <p class="book-card-autor">{{ $libro['autor'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="#" class="btn btn-hero btn-ver-mas">Ver más +</a>
        </div>
    </div>
</section>

{{-- ============================================================
     SECCIÓN: SOBRE NUESTRA LIBRERÍA
============================================================ --}}
<section class="about-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2 class="section-title font-italiana mb-4">Sobre nuestra librería</h2>
                <p class="about-text">
                    En Amateca Librería, nos apasiona conectar a las personas con historias que inspiran, enseñan y
                    acompañan. Somos un espacio acogedor donde cada libro tiene algo especial para ofrecerte.
                </p>

                <h4 class="about-subtitle font-italiana mt-4">Ubicación</h4>
                <p class="about-text">
                    Nos encontramos en el corazón de la ciudad, en una zona accesible y tranquila para que disfrutes tu visita:
                </p>
                <p class="about-text"><strong>Avenida Los Lectores, #123, San Salvador</strong></p>

                <h4 class="about-subtitle font-italiana mt-4">Horarios</h4>
                <p class="about-text">Estamos disponibles para ti en los siguientes horarios:</p>
                <ul class="about-list">
                    <li>Lunes a viernes: 9:00 AM – 7:00 PM</li>
                    <li>Sábados: 9:00 AM – 5:00 PM</li>
                    <li>Domingos: Cerrado</li>
                </ul>

                <h4 class="about-subtitle font-italiana mt-4">Contacto</h4>
                <p class="about-text">¿Tienes alguna consulta o buscas un libro específico?</p>
                <ul class="about-list">
                    <li>Teléfono: 2222-5678</li>
                    <li>WhatsApp: 7890-1234</li>
                    <li>Correo: contacto@amateca.com</li>
                </ul>
            </div>

            {{-- ESPACIO PARA IMAGEN PILA DE LIBROS --}}
            <div class="col-md-5 d-flex align-items-center justify-content-center">
                <div class="about-img-placeholder">
                    <img src="{{ asset('images/stack-books.png') }}"
                         alt="Pila de libros"
                         class="about-img"
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Carrusel JS --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const items = document.querySelectorAll('.book-item');
        let current = 2; // empieza en el del centro
        const total = items.length;

        function updateCarousel() {
            items.forEach((item, i) => {
                item.classList.remove('active', 'side-left', 'side-right', 'far-left', 'far-right', 'hidden');

                const diff = ((i - current) % total + total) % total;
                const revDiff = ((current - i) % total + total) % total;

                if (diff === 0) {
                    item.classList.add('active');
                } else if (diff === 1) {
                    item.classList.add('side-right');
                } else if (revDiff === 1) {
                    item.classList.add('side-left');
                } else if (diff === 2) {
                    item.classList.add('far-right');
                } else if (revDiff === 2) {
                    item.classList.add('far-left');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        document.getElementById('nextBtn').addEventListener('click', function () {
            current = (current + 1) % total;
            updateCarousel();
        });

        document.getElementById('prevBtn').addEventListener('click', function () {
            current = (current - 1 + total) % total;
            updateCarousel();
        });

        updateCarousel();
    });
</script>

</body>
</html>