<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amateca - Tu próxima aventura comienza aquí</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

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
    <a class="navbar-brand d-flex flex-column align-items-center" href="#">
        <div class="logo-placeholder">
            <img src="{{ asset('img/logoSinFondo.png') }}" alt="Logo Amateca" class="logo-img">
        </div>
        <span class="brand-name">AMATECA</span>
    </a>
    <div class="ms-auto d-flex gap-2 gap-md-3">
        <a href="{{ route('register') }}" class="btn btn-hero btn-sm-hero">Crear cuenta</a>
        <a href="{{ route('login') }}" class="btn btn-hero btn-sm-hero">Iniciar Sesión</a>
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
                        ['cover'=>'https://covers.openlibrary.org/b/id/10909258-L.jpg','titulo'=>'El Príncipe Cruel','autor'=>'Holly Black','genero'=>'Fantasía','precio'=>'$12.99','desc'=>'Jude fue llevada al mundo de las hadas siendo niña. Ahora desea pertenecer a ese mundo aunque tenga que ganar su lugar a base de astucia y traición.'],
                        ['cover'=>'https://covers.openlibrary.org/b/id/12547305-L.jpg','titulo'=>'Wintersong','autor'=>'S. Jae-Jones','genero'=>'Romance','precio'=>'$10.50','desc'=>'Una joven pianista es llevada al mundo subterráneo del Rey de los Elfos, donde deberá elegir entre su pasión y su libertad.'],
                        ['cover'=>'https://covers.openlibrary.org/b/id/10909258-L.jpg','titulo'=>'Damián','autor'=>'Alex Mírez','genero'=>'Romance','precio'=>'$9.99','desc'=>'Un secreto oscuro y perverso. Damián es un hombre de sombras y misterios, y ella está a punto de descubrirlos todos.'],
                        ['cover'=>'https://covers.openlibrary.org/b/id/8739161-L.jpg','titulo'=>'Érase una vez un Corazón Roto','autor'=>'Stephanie Garber','genero'=>'Fantasía','precio'=>'$13.00','desc'=>'Evangeline Fox siempre creyó en los cuentos de hadas. Ahora está a punto de vivir el más oscuro de todos.'],
                        ['cover'=>'https://covers.openlibrary.org/b/id/10521270-L.jpg','titulo'=>'Historias Oscuras','autor'=>'Navessa Allen','genero'=>'Terror','precio'=>'$11.25','desc'=>'Una colección de relatos que te mantendrán en vela. Oscuros, perturbadores y completamente adictivos.'],
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

       <div class="books-row-placeholder mt-4 reveal-up" style="display:block; white-space:nowrap; font-size:0; line-height:0;">
            <img src="{{ asset('img/filaLibros.png') }}" alt="Fila de libros" style="display:inline; margin:0; padding:0; border:0; vertical-align:top;">
            <img src="{{ asset('img/filaLibros.png') }}" alt="Fila de libros" style="display:inline; margin:0; padding:0; border:0; vertical-align:top;">
            <img src="{{ asset('img/filaLibros.png') }}" alt="Fila de libros" style="display:inline; margin:0; padding:0; border:0; vertical-align:top;">
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
                $categorias = [
                    ['nombre'=>'Terror','img'=>'cat-terror.jpg'],
                    ['nombre'=>'Romance','img'=>'cat-romance.jpg'],
                    ['nombre'=>'Fantasía','img'=>'cat-fantasia.jpg'],
                    ['nombre'=>'Espiritual','img'=>'cat-espiritual.jpg'],
                    ['nombre'=>'Política','img'=>'cat-politica.jpg'],
                    ['nombre'=>'Autoayuda','img'=>'cat-autoayuda.jpg'],
                    ['nombre'=>'Infantil','img'=>'cat-infantil.jpg'],
                    ['nombre'=>'Adulto-Joven','img'=>'cat-adultojoven.jpg'],
                ];
            @endphp

            @foreach($categorias as $index => $cat)
            <div class="col-6 col-sm-4 col-md-3 reveal-up" style="--reveal-delay: {{ $index * 0.08 }}s">
                <a href="#" class="category-card">
                    <div class="cat-img-placeholder">
                        <img src="{{ asset('images/categorias/' . $cat['img']) }}"
                             alt="{{ $cat['nombre'] }}" class="cat-img"
                             onerror="this.style.display='none'">
                    </div>
                    <span class="cat-name">{{ $cat['nombre'] }}</span>
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
            @php
                $populares = [
                    ['titulo'=>'El Nombre del Viento','precio'=>'$14.99','autor'=>'Patrick Rothfuss','genero'=>'Fantasía','cover'=>'','desc'=>'La historia de Kvothe, un estudiante de magia que se convierte en leyenda. Una obra maestra de la fantasía épica.'],
                    ['titulo'=>'It','precio'=>'$13.50','autor'=>'Stephen King','genero'=>'Terror','cover'=>'','desc'=>'En Derry, Maine, siete niños se enfrentan a un terror ancestral que toma la forma de sus peores miedos.'],
                    ['titulo'=>'Orgullo y Prejuicio','precio'=>'$8.99','autor'=>'Jane Austen','genero'=>'Romance','cover'=>'','desc'=>'La historia de amor entre Elizabeth Bennet y el señor Darcy, un clásico de la literatura universal.'],
                    ['titulo'=>'El Alquimista','precio'=>'$10.00','autor'=>'Paulo Coelho','genero'=>'Autoayuda','cover'=>'','desc'=>'Un joven pastor emprende un viaje hacia la realización de su sueño personal en esta novela filosófica.'],
                    ['titulo'=>'Cien Años de Soledad','precio'=>'$12.00','autor'=>'Gabriel García Márquez','genero'=>'Ficción','cover'=>'','desc'=>'La saga de la familia Buendía en el mítico Macondo, una obra cumbre del realismo mágico.'],
                    ['titulo'=>'Harry Potter','precio'=>'$15.00','autor'=>'J.K. Rowling','genero'=>'Fantasía','cover'=>'','desc'=>'Un niño descubre que es un mago y es admitido en la escuela de magia y hechicería de Hogwarts.'],
                    ['titulo'=>'La Sombra del Viento','precio'=>'$11.50','autor'=>'Carlos Ruiz Zafón','genero'=>'Misterio','cover'=>'','desc'=>'Barcelona, 1945. Un niño descubre un libro misterioso que cambiará su vida para siempre.'],
                    ['titulo'=>'Dune','precio'=>'$13.00','autor'=>'Frank Herbert','genero'=>'Ciencia Ficción','cover'=>'','desc'=>'En el planeta desértico Arrakis, Paul Atreides descubre su destino como líder de un pueblo oprimido.'],
                ];
            @endphp

            @foreach($populares as $index => $libro)
            <div class="col-6 col-sm-4 col-md-3 reveal-up" style="--reveal-delay: {{ $index * 0.07 }}s">
                <div class="book-card"
                     data-cover="{{ $libro['cover'] }}"
                     data-titulo="{{ $libro['titulo'] }}"
                     data-autor="{{ $libro['autor'] }}"
                     data-genero="{{ $libro['genero'] }}"
                     data-precio="{{ $libro['precio'] }}"
                     data-desc="{{ $libro['desc'] }}">
                    <div class="book-card-img-placeholder">
                        <img src="{{ asset('images/libros/' . Str::slug($libro['titulo']) . '.jpg') }}"
                             alt="{{ $libro['titulo'] }}" class="book-card-img"
                             onerror="this.style.display='none'">
                        <div class="img-placeholder-icon"><i class="bi bi-image"></i></div>
                        <div class="book-card-hover-overlay">
                            <i class="bi bi-eye-fill"></i>
                            <span>Ver detalle</span>
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

        <div class="text-center mt-4 mt-md-5 reveal-up">
            <a href="#" class="btn btn-hero btn-ver-mas">Ver más +</a>
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
                <div class="about-img-placeholder">
                    <img src="{{ asset('images/stack-books.png') }}" alt="Pila de libros" class="about-img" onerror="this.style.display='none'">
                </div>
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

    /* ── 8. Click tarjeta popular → modal ── */
    document.querySelectorAll('.book-card').forEach(card => {
        card.addEventListener('click', () => openModal({
            cover: card.dataset.cover, titulo: card.dataset.titulo,
            autor: card.dataset.autor, genero: card.dataset.genero,
            precio: card.dataset.precio, desc: card.dataset.desc,
        }));
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
</body>
</html>