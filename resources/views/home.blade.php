<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐈𝐧𝐢𝐜𝐢𝐨</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
</head>


<body>


    <x-loader />


{{-- ============================================================
     MODAL DE LIBRO
============================================================ --}}
<div class="book-modal-overlay" id="bookModalOverlay">
    <div class="book-modal" id="bookModal">
        <button class="book-modal-close" id="bookModalClose">
            <i class="bi bi-x-lg"></i>
        </button>
        <div class="book-modal-inner">
            <div class="book-modal-img-wrap">
                <img src="" alt="" id="modalBookCover" class="book-modal-cover">
                <div class="modal-img-placeholder-icon"><i class="bi bi-book"></i></div>
            </div>
            <div class="book-modal-info">
                <h3 class="modal-book-title" id="modalBookTitle">Título del libro</h3>
                <p class="modal-book-author"><i class="bi bi-person"></i> <span id="modalBookAuthor">Autor</span></p>
                <p class="modal-book-genre"><i class="bi bi-tag"></i> <span id="modalBookGenre">Género</span></p>
                <p class="modal-book-price" id="modalBookPrice">$0.00</p>
                <p class="modal-book-desc" id="modalBookDesc">Descripción del libro.</p>
                <div class="modal-book-actions">
                    <button class="btn btn-hero btn-modal-buy">Comprar ahora</button>
                    <button class="btn btn-modal-wish"><i class="bi bi-heart"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ============================================================
     NAVBAR
============================================================ --}}
<nav class="navbar navbar-light bg-white px-4 py-3" id="mainNav">
    <a class="navbar-brand d-flex flex-column align-items-center" href="{{ route('home') }}">
        <div class="logo-placeholder">
            <img src="{{ asset('img/logoSinFondo.png') }}" alt="Logo Amateca" class="logo-img">
        </div>
    </a>
    <div class="ms-auto d-flex gap-2 gap-md-3 align-items-center">
        @auth
            <a href="{{ route('buscar') }}" class="btn btn-hero btn-sm-hero">Buscar</a>
            <a href="{{ route('dashboard') }}" class="btn btn-hero btn-sm-hero">Mi cuenta</a>
        @else
            <a href="{{ route('register') }}" class="btn btn-hero btn-sm-hero">Crear cuenta</a>
            <a href="{{ route('login') }}" class="btn btn-hero btn-sm-hero">Iniciar Sesión</a>
        @endauth
    </div>
</nav>


{{-- ============================================================
     HERO SECTION
============================================================ --}}
<section class="hero-section">
    <div class="container-fluid px-3 px-md-4">
        <div class="row align-items-center min-vh-80">


            <div class="col-12 col-md-6 hero-text">
                <h1 class="hero-title reveal-left">
                    <span class="font-italiana fst-italic">Tu próxima</span><br>
                    aventura<br>
                    comienza aquí..
                </h1>
                <a href="#libros" class="btn btn-hero mt-4 reveal-left reveal-delay-2">Comencemos</a>
            </div>


            <div class="col-12 col-md-6 hero-image-col d-flex justify-content-center align-items-center">
                <div class="hero-float-group reveal-scale">
                    <div class="hero-oval-bg"></div>
                    <div class="hero-img-placeholder">
                        <img src="{{ asset('img/libro.png') }}" alt="Libro con flores" class="hero-book-img">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="wave-divider wave-bottom-white"></div>


    <div class="scroll-hint" id="scrollHint">
        <i class="bi bi-chevron-down"></i>
    </div>
</section>


{{-- ============================================================
     SECCIÓN: CARRUSEL
============================================================ --}}
<section class="carousel-section" id="libros">
    <div class="wave-top-down"></div>


    <div class="container text-center py-4 py-md-5">
        <h2 class="section-title font-italiana mb-4 mb-md-5 reveal-up">Miles de historias te están esperando</h2>


        <div class="book-carousel-wrapper position-relative reveal-up reveal-delay-1">
            <button class="carousel-arrow arrow-left" id="prevBtn" aria-label="Anterior">
                <i class="bi bi-chevron-left"></i>
            </button>


            <div class="book-carousel" id="bookCarousel">
                @php
                    $carouselBooks = [
                        ['cover'=>'https://ellector.com.py/product_photos/24b89be1/610e70bba50eedfba4342a754f793710.jpg','titulo'=>'El Príncipe Cruel','autor'=>'Holly Black','genero'=>'Fantasía','precio'=>'$29.99','desc'=>'Jude fue llevada al mundo de las hadas siendo niña. Ahora desea pertenecer a ese mundo aunque tenga que ganar su lugar a base de astucia y traición.'],
                        ['cover'=>'https://www.bookup.com.mx/cdn/shop/files/9780593972700.jpg?v=1737159599&width=713','titulo'=>'Alchemised','autor'=>'Senlinyu','genero'=>'Dark fantasy','precio'=>'$34.95','desc'=>'En este debut fascinante de dark fantasy, una mujer sin memoria lucha por sobrevivir en un mundo de necromancia y alquimia devastado por la guerra… y al hombre encargado de desenterrar los secretos más oscuros de su pasado.'],
                        ['cover'=>'https://ellector.com.py/product_photos/24b89be1/e302a9e8bd83b0604d7b88b44bce35e0.jpg','titulo'=>'Damián','autor'=>'Alex Mírez','genero'=>'Romance','precio'=>'$30.99','desc'=>'Un secreto oscuro y perverso. Damián es un hombre de sombras y misterios, y ella está a punto de descubrirlos todos.'],
                        ['cover'=>'https://www.edicionesurano.com/media/cache/58/19/5819130b88bfe9dd73fc80b9cedc2881.jpg','titulo'=>'Érase una vez un Corazón Roto','autor'=>'Stephanie Garber','genero'=>'Fantasía','precio'=>'$19.00','desc'=>'Evangeline Fox siempre creyó en los cuentos de hadas. Ahora está a punto de vivir el más oscuro de todos.'],
                        ['cover'=>'https://imagessl2.casadellibro.com/a/l/s7/52/9788478884452.webp','titulo'=>'Harry Potter','autor'=>'JK Rowling','genero'=>'Fantasía','precio'=>'$25.00','desc'=>'Harry Potter y la piedra filosofal es el primer volumen de la ya clásica serie de novelas fantásticas de la autora británica J.K. Rowling.'],
                    ];
                @endphp


                @foreach($carouselBooks as $index => $book)
                <div class="book-item {{ $index === 2 ? 'active' : '' }}"
                     data-index="{{ $index }}"
                     data-cover="{{ $book['cover'] }}"
                     data-titulo="{{ $book['titulo'] }}"
                     data-autor="{{ $book['autor'] }}"
                     data-genero="{{ $book['genero'] }}"
                     data-precio="{{ $book['precio'] }}"
                     data-desc="{{ $book['desc'] }}">
                    <img src="{{ $book['cover'] }}" alt="{{ $book['titulo'] }}" class="book-cover">
                    <div class="book-item-click-hint"><i class="bi bi-eye"></i></div>
                </div>
                @endforeach
            </div>


            <button class="carousel-arrow arrow-right" id="nextBtn" aria-label="Siguiente">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>


        {{-- Dots indicadores --}}
        <div class="carousel-dots mt-4" id="carouselDots">
            @foreach($carouselBooks as $index => $book)
                <span class="carousel-dot {{ $index === 2 ? 'active' : '' }}" data-dot="{{ $index }}"></span>
            @endforeach
        </div>


        <p class="subtitle-text mt-3 mt-md-4 reveal-up reveal-delay-2">Encuentra exactamente lo que buscas… y más.</p>
    </div>
</section>


{{-- ============================================================
     SECCIÓN: PROMOCIONES
============================================================ --}}
<section class="promo-section py-5">
    <div class="container">
        <h2 class="section-title font-italiana text-center mb-4 mb-md-5 reveal-up">Promociones pensadas para ti</h2>


        <div class="row align-items-center gy-4">
            <div class="col-12 col-md-8 reveal-left">
                <div class="promo-card d-flex align-items-start gap-3 gap-md-4">
                    <div class="promo-oval-bg"></div>
                    <div class="promo-text ps-2 ps-md-3">
                        <p class="promo-desc">
                            Hasta 20% de descuento en títulos de Fantasía<br>
                            durante todo el mes de Mayo
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 text-center reveal-right">
                <div class="discount-badge">
                    <span class="discount-number">20</span><span class="discount-percent">%</span>
                </div>
            </div>
        </div>


        <div class="books-row-placeholder mt-4 reveal-up">
            <img src="{{ asset('img/fila.png') }}" alt="Fila de libros" class="books-row-img">
        </div>


</section>


{{-- ============================================================
     SECCIÓN: CATEGORÍAS
============================================================ --}}
<section class="categories-section py-5">
    <div class="container">
        <h2 class="section-title font-italiana text-center mb-4 mb-md-5 reveal-up">Explora nuestras categorías</h2>


        <div class="row g-3 g-md-4 justify-content-center">
            @php
                $homeCatImages = [
                    'Terror y Suspenso'       => 'https://i.pinimg.com/736x/cc/58/c4/cc58c473a9109bc1131739edcb0fa689.jpg',
                    'Romance'                 => 'https://images.unsplash.com/photo-1518199266791-5375a83190b7?w=600&q=80',
                    'Ciencia Ficción y Fantasía' => 'https://i.pinimg.com/736x/7d/a9/c7/7da9c76483e5f32f1e898c1a665d23b1.jpg',
                    'Autoayuda'               => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=600&q=80',
                    'Historia'                => 'https://i.pinimg.com/736x/14/75/5f/14755f89e249821c2aa7714c702fb496.jpg',
                    'Novela'                  => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&q=80',
                    'Literatura Infantil'     => 'https://i.pinimg.com/originals/f1/cc/d8/f1ccd8cf384333e96376bc6760ebb163.png',
                    'Literatura Juvenil'      => 'https://i.pinimg.com/1200x/10/aa/e6/10aae6551fff01cf8d9e3449b4608dd4.jpg',
                ];
            @endphp


            @foreach($categorias->take(8) as $index => $cat)
            <div class="col-6 col-sm-4 col-md-3 reveal-up" style="--reveal-delay: {{ $index * 0.08 }}s">
                <a href="{{ route('buscar') }}?categoria={{ $cat->id }}" class="category-card">
                    <img src="{{ $homeCatImages[$cat->nombre] ?? 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=600&q=80' }}"
                         alt="{{ $cat->nombre }}" class="cat-bg-img">
                    <div class="cat-overlay"></div>
                    <span class="cat-name">{{ $cat->nombre }}</span>
                    <div class="cat-hover-content">
                        <i class="bi bi-book-half"></i>
                        <span>Ver libros</span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     SECCIÓN: MÁS POPULARES
============================================================ --}}
<section class="populares-section">
    <div class="wave-top-pink-light"></div>


    <div class="container pb-5">
        <div class="d-flex align-items-center mb-3 mb-md-4 reveal-left">
            <h3 class="populares-title me-2">Más populares</h3>
            <i class="bi bi-chevron-right"></i>
        </div>


        <div class="row g-2 g-md-3">
            @forelse($libros as $index => $libro)
            <div class="col-6 col-sm-4 col-md-3 reveal-up" style="--reveal-delay: {{ $index * 0.07 }}s">
                @auth
                <a href="{{ route('libros.show', $libro) }}" style="text-decoration:none;color:inherit;">
                @else
                <div data-login-redirect="true">
                @endauth
                    <div class="book-card" data-id="{{ $libro->id }}">
                        <div class="book-card-img-placeholder">
                            @if($libro->imagen_portada)
                                <img src="{{ asset('storage/' . $libro->imagen_portada) }}"
                                     alt="{{ $libro->titulo }}" class="book-card-img">
                            @else
                                <div style="width:100%;height:100%;background:#FDE6E6;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-book-half" style="font-size:2.5rem;color:#FFB2B2;"></i>
                                </div>
                            @endif
                            <div class="book-card-hover-overlay">
                                <i class="bi bi-eye-fill"></i>
                                <span>Ver detalle</span>
                            </div>
                        </div>
                        <div class="book-card-body">
                            <p class="book-card-title">{{ Str::limit($libro->titulo, 28) }}</p>
                            <p class="book-card-price">${{ number_format($libro->precio, 2) }}</p>
                            <p class="book-card-autor">{{ $libro->author->nombre ?? '—' }}</p>
                        </div>
                    </div>
                @auth
                </a>
                @else
                </div>
                @endauth
            </div>
            @empty
            <div class="col-12 text-center py-5" style="color:#888;">
                <i class="bi bi-book" style="font-size:3rem;display:block;margin-bottom:.75rem;"></i>
                No hay libros disponibles aún.
            </div>
            @endforelse
        </div>


        <div class="text-center mt-4 mt-md-5 reveal-up">
            @auth
                <a href="{{ route('buscar') }}" class="btn btn-hero btn-ver-mas">Ver más +</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-hero btn-ver-mas">Ver más +</a>
            @endauth
        </div>
    </div>
</section>


{{-- ============================================================
     SECCIÓN: SOBRE NUESTRA LIBRERÍA
============================================================ --}}
<section class="about-section py-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12 col-md-7 reveal-left">
                <h2 class="section-title font-italiana mb-3 mb-md-4">Sobre nuestra librería</h2>
                <p class="about-text">En Amateca Librería, nos apasiona conectar a las personas con historias que inspiran, enseñan y acompañan. Somos un espacio acogedor donde cada libro tiene algo especial para ofrecerte.</p>


                <h4 class="about-subtitle font-italiana mt-4">Ubicación</h4>
                <p class="about-text">Nos encontramos en el corazón de la ciudad, en una zona accesible y tranquila para que disfrutes tu visita:</p>
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


            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center reveal-right">
                <img src="{{ asset('img/fila.png') }}" alt="Fila de libros" class="about-img">
            </div>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {


    /* ── 1. Navbar sombra al scroll ── */
    const nav = document.getElementById('mainNav');
    window.addEventListener('scroll', () => nav.classList.toggle('nav-scrolled', window.scrollY > 30), { passive: true });


    /* ── 2. Scroll hint fade ── */
    const hint = document.getElementById('scrollHint');
    window.addEventListener('scroll', () => { hint.style.opacity = window.scrollY > 60 ? '0' : '1'; }, { passive: true });


    /* ── 3. Reveal on scroll (Intersection Observer) ── */
    const revealEls = document.querySelectorAll('.reveal-up, .reveal-left, .reveal-right, .reveal-scale');
    const revealObs = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                el.style.transitionDelay = el.style.getPropertyValue('--reveal-delay') || '0s';
                el.classList.add('revealed');
                revealObs.unobserve(el);
            }
        });
    }, { threshold: 0.10 });
    revealEls.forEach(el => revealObs.observe(el));


    /* Hero: anima inmediatamente */
    document.querySelectorAll('.hero-section .reveal-left, .hero-section .reveal-scale')
        .forEach((el, i) => setTimeout(() => el.classList.add('revealed'), 150 + i * 130));


    /* ── 4. Modal ── */
    const overlay    = document.getElementById('bookModalOverlay');
    const modalClose = document.getElementById('bookModalClose');


    function openModal(data) {
        const cover = document.getElementById('modalBookCover');
        cover.src = data.cover || '';
        cover.alt = data.titulo || '';
        cover.style.display = data.cover ? 'block' : 'none';
        document.querySelector('.modal-img-placeholder-icon').style.display = data.cover ? 'none' : 'flex';


        document.getElementById('modalBookTitle').textContent  = data.titulo || 'Sin título';
        document.getElementById('modalBookAuthor').textContent = data.autor  || 'Desconocido';
        document.getElementById('modalBookGenre').textContent  = data.genero || '—';
        document.getElementById('modalBookPrice').textContent  = data.precio || '';
        document.getElementById('modalBookDesc').textContent   = data.desc   || '';
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }


    function closeModal() {
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }


    modalClose.addEventListener('click', closeModal);
    overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });


    /* ── 5. Carrusel 3D ── */
    const items = document.querySelectorAll('.book-item');
    const dots  = document.querySelectorAll('.carousel-dot');
    let current = 2;
    const total = items.length;


    function updateCarousel() {
        items.forEach((item, i) => {
            item.classList.remove('active','side-left','side-right','far-left','far-right','hidden');
            const diff    = ((i - current) % total + total) % total;
            const revDiff = ((current - i) % total + total) % total;
            if      (diff === 0)    item.classList.add('active');
            else if (diff === 1)    item.classList.add('side-right');
            else if (revDiff === 1) item.classList.add('side-left');
            else if (diff === 2)    item.classList.add('far-right');
            else if (revDiff === 2) item.classList.add('far-left');
            else                    item.classList.add('hidden');
        });
        dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }


    document.getElementById('nextBtn').addEventListener('click', () => { current = (current + 1) % total; updateCarousel(); });
    document.getElementById('prevBtn').addEventListener('click', () => { current = (current - 1 + total) % total; updateCarousel(); });


    dots.forEach(dot => {
        dot.addEventListener('click', () => { current = parseInt(dot.dataset.dot); updateCarousel(); });
    });


    let autoPlay = setInterval(() => { current = (current + 1) % total; updateCarousel(); }, 3500);
    const carouselEl = document.getElementById('bookCarousel');
    carouselEl.addEventListener('mouseenter', () => clearInterval(autoPlay));
    carouselEl.addEventListener('mouseleave', () => {
        autoPlay = setInterval(() => { current = (current + 1) % total; updateCarousel(); }, 3500);
    });


    /* Swipe en móvil para carrusel */
    let touchStartX = 0;
    carouselEl.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
    carouselEl.addEventListener('touchend', e => {
        const diff = touchStartX - e.changedTouches[0].screenX;
        if (Math.abs(diff) > 40) {
            if (diff > 0) { current = (current + 1) % total; }
            else          { current = (current - 1 + total) % total; }
            updateCarousel();
        }
    });


    /* Click libro carrusel → modal */
    items.forEach(item => {
        item.addEventListener('click', () => openModal({
            cover: item.dataset.cover, titulo: item.dataset.titulo,
            autor: item.dataset.autor, genero: item.dataset.genero,
            precio: item.dataset.precio, desc: item.dataset.desc,
        }));
    });


    updateCarousel();


    /* ── 6. Parallax oval en desktop ── */
    if (window.innerWidth > 768) {
        const oval = document.querySelector('.hero-oval-bg');
        window.addEventListener('scroll', () => {
            if (oval) oval.style.transform = `translate(-50%, calc(-50% + ${window.scrollY * 0.06}px))`;
        }, { passive: true });
    }


    /* ── 7. Hover tilt 3D en tarjetas (solo desktop) ── */
    if (window.innerWidth > 768) {
        document.querySelectorAll('.book-card, .category-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width  - 0.5;
                const y = (e.clientY - rect.top)  / rect.height - 0.5;
                card.style.transform = `perspective(600px) rotateY(${x * 10}deg) rotateX(${-y * 8}deg) translateY(-4px)`;
            });
            card.addEventListener('mouseleave', () => { card.style.transform = ''; });
        });
    }


    /* ── 8. Click tarjeta popular → redirigir a login si es invitado ── */
    document.querySelectorAll('[data-login-redirect]').forEach(wrapper => {
        wrapper.style.cursor = 'pointer';
        wrapper.addEventListener('click', () => {
            window.location.href = '{{ route("login") }}';
        });
    });


    /* ── 9. Contador animado badge descuento ── */
    const badge = document.querySelector('.discount-number');
    if (badge) {
        new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                let c = 0;
                const iv = setInterval(() => { badge.textContent = ++c; if (c >= 20) clearInterval(iv); }, 45);
            }
        }, { threshold: 0.6 }).observe(badge);
    }


    /* ── 10. Ripple en botones ── */
    document.querySelectorAll('.btn-hero').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const r = document.createElement('span');
            r.className = 'btn-ripple';
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;`;
            btn.appendChild(r);
            r.addEventListener('animationend', () => r.remove());
        });
    });


});
</script>


<x-footer />
</body>
</html>

