{{--
    DASHBOARD - Página principal tras iniciar sesión
    Ubicación: resources/views/dashboard.blade.php
--}}
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
         SECCIÓN: RECIÉN LLEGADOS
    ============================================================ --}}
    <section class="dash-section" id="recien">
        <div class="container">
            <div class="dash-section-header">
                <h2 class="dash-section-title">Recién llegados</h2>
                <a href="#" class="dash-see-all">Ver todos <i class="bi bi-chevron-right"></i></a>
            </div>

            <div class="row g-3">
                @php
                    $recientes = [
                        ['titulo'=>'El Príncipe Cruel',        'autor'=>'Holly Black',        'precio'=>'$29.99', 'cover'=>'https://ellector.com.py/product_photos/24b89be1/610e70bba50eedfba4342a754f793710.jpg',  'genero'=>'Fantasía',       'desc'=>'Jude fue llevada al mundo de las hadas siendo niña. Ahora desea pertenecer a ese mundo aunque tenga que ganar su lugar a base de astucia y traición.'],
                        ['titulo'=>'Alchemised',               'autor'=>'Senlinyu',           'precio'=>'$34.95', 'cover'=>'https://www.bookup.com.mx/cdn/shop/files/9780593972700.jpg?v=1737159599&width=713',     'genero'=>'Dark Fantasy',   'desc'=>'Una mujer sin memoria lucha por sobrevivir en un mundo de necromancia y alquimia devastado por la guerra.'],
                        ['titulo'=>'Damián',                   'autor'=>'Alex Mírez',         'precio'=>'$30.99', 'cover'=>'https://ellector.com.py/product_photos/24b89be1/e302a9e8bd83b0604d7b88b44bce35e0.jpg',  'genero'=>'Romance',        'desc'=>'Un secreto oscuro y perverso. Damián es un hombre de sombras y misterios, y ella está a punto de descubrirlos todos.'],
                        ['titulo'=>'Érase una vez un Corazón Roto','autor'=>'Stephanie Garber','precio'=>'$19.00','cover'=>'https://www.edicionesurano.com/media/cache/58/19/5819130b88bfe9dd73fc80b9cedc2881.jpg',  'genero'=>'Fantasía',       'desc'=>'Evangeline Fox siempre creyó en los cuentos de hadas. Ahora está a punto de vivir el más oscuro de todos.'],
                    ];
                @endphp

                @foreach($recientes as $libro)
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="dash-book-card"
                         data-cover="{{ $libro['cover'] }}"
                         data-titulo="{{ $libro['titulo'] }}"
                         data-autor="{{ $libro['autor'] }}"
                         data-genero="{{ $libro['genero'] }}"
                         data-precio="{{ $libro['precio'] }}"
                         data-desc="{{ $libro['desc'] }}">
                        <div class="dash-book-img-wrap">
                            <img src="{{ $libro['cover'] }}" alt="{{ $libro['titulo'] }}" class="dash-book-img"
                                 onerror="this.style.display='none'">
                            <div class="dash-book-overlay">
                                <i class="bi bi-eye-fill"></i>
                                <span>Ver detalle</span>
                            </div>
                            <button class="dash-wish-btn" title="Guardar"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="dash-book-info">
                            <p class="dash-book-title">{{ $libro['titulo'] }}</p>
                            <p class="dash-book-price">{{ $libro['precio'] }}</p>
                            <p class="dash-book-autor">{{ $libro['autor'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         SECCIÓN: FAVORITOS DE LOS LECTORES
    ============================================================ --}}
    <section class="dash-section" id="favoritos">
        <div class="container">
            <div class="dash-section-header">
                <h2 class="dash-section-title">Favoritos de los lectores</h2>
                <a href="#" class="dash-see-all">Ver todos <i class="bi bi-chevron-right"></i></a>
            </div>

            <div class="row g-3">
                @php
                    $favoritos = [
                        ['titulo'=>'El Nombre del Viento', 'autor'=>'Patrick Rothfuss',      'precio'=>'$14.99', 'cover'=>'https://covers.openlibrary.org/b/id/8739161-L.jpg',  'genero'=>'Fantasía',       'desc'=>'La historia de Kvothe, un estudiante de magia que se convierte en leyenda. Una obra maestra de la fantasía épica.'],
                        ['titulo'=>'It',                   'autor'=>'Stephen King',           'precio'=>'$13.50', 'cover'=>'https://covers.openlibrary.org/b/id/8231432-L.jpg',  'genero'=>'Terror',         'desc'=>'En Derry, Maine, siete niños se enfrentan a un terror ancestral que toma la forma de sus peores miedos.'],
                        ['titulo'=>'Orgullo y Prejuicio',  'autor'=>'Jane Austen',            'precio'=>'$8.99',  'cover'=>'https://covers.openlibrary.org/b/id/8739351-L.jpg',  'genero'=>'Romance',        'desc'=>'La historia de amor entre Elizabeth Bennet y el señor Darcy, un clásico de la literatura universal.'],
                        ['titulo'=>'El Alquimista',        'autor'=>'Paulo Coelho',           'precio'=>'$10.00', 'cover'=>'https://covers.openlibrary.org/b/id/8231856-L.jpg',  'genero'=>'Autoayuda',      'desc'=>'Un joven pastor emprende un viaje hacia la realización de su sueño personal.'],
                    ];
                @endphp

                @foreach($favoritos as $libro)
                <div class="col-6 col-sm-4 col-md-3">
                    <div class="dash-book-card"
                         data-cover="{{ $libro['cover'] }}"
                         data-titulo="{{ $libro['titulo'] }}"
                         data-autor="{{ $libro['autor'] }}"
                         data-genero="{{ $libro['genero'] }}"
                         data-precio="{{ $libro['precio'] }}"
                         data-desc="{{ $libro['desc'] }}">
                        <div class="dash-book-img-wrap">
                            <img src="{{ $libro['cover'] }}" alt="{{ $libro['titulo'] }}" class="dash-book-img"
                                 onerror="this.style.display='none'">
                            <div class="dash-book-overlay">
                                <i class="bi bi-eye-fill"></i>
                                <span>Ver detalle</span>
                            </div>
                            <button class="dash-wish-btn" title="Guardar"><i class="bi bi-heart"></i></button>
                        </div>
                        <div class="dash-book-info">
                            <p class="dash-book-title">{{ $libro['titulo'] }}</p>
                            <p class="dash-book-price">{{ $libro['precio'] }}</p>
                            <p class="dash-book-autor">{{ $libro['autor'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         MODAL DE LIBRO
    ============================================================ --}}
    <div class="dash-modal-overlay" id="dashModalOverlay">
        <div class="dash-modal">
            <button class="dash-modal-close" id="dashModalClose"><i class="bi bi-x-lg"></i></button>
            <div class="dash-modal-inner">
                <div class="dash-modal-img-wrap">
                    <img src="" alt="" id="dashModalCover" class="dash-modal-cover">
                    <div class="dash-modal-img-placeholder"><i class="bi bi-book"></i></div>
                </div>
                <div class="dash-modal-info">
                    <h3 class="dash-modal-title" id="dashModalTitle">Título</h3>
                    <p class="dash-modal-author"><i class="bi bi-person"></i> <span id="dashModalAuthor"></span></p>
                    <p class="dash-modal-genre"><i class="bi bi-tag"></i> <span id="dashModalGenre"></span></p>
                    <p class="dash-modal-price" id="dashModalPrice"></p>
                    <p class="dash-modal-desc" id="dashModalDesc"></p>
                    <div class="dash-modal-actions">
                        <button class="dash-btn-buy">Comprar ahora</button>
                        <button class="dash-btn-wish"><i class="bi bi-heart"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        /* ── Navbar sombra al scroll ── */
        const nav = document.getElementById('dashNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 20);
        }, { passive: true });

        /* ── Avatar dropdown ── */
        const avatarBtn      = document.getElementById('avatarBtn');
        const avatarDropdown = document.getElementById('avatarDropdown');
        avatarBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            avatarDropdown.classList.toggle('open');
        });
        document.addEventListener('click', () => avatarDropdown.classList.remove('open'));

        /* ── Modal ── */
        const overlay    = document.getElementById('dashModalOverlay');
        const closeBtn   = document.getElementById('dashModalClose');

        function openModal(data) {
            const cover = document.getElementById('dashModalCover');
            cover.src           = data.cover || '';
            cover.style.display = data.cover ? 'block' : 'none';
            document.querySelector('.dash-modal-img-placeholder').style.display = data.cover ? 'none' : 'flex';
            document.getElementById('dashModalTitle').textContent  = data.titulo || '';
            document.getElementById('dashModalAuthor').textContent = data.autor  || '';
            document.getElementById('dashModalGenre').textContent  = data.genero || '';
            document.getElementById('dashModalPrice').textContent  = data.precio || '';
            document.getElementById('dashModalDesc').textContent   = data.desc   || '';
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        closeBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

        document.querySelectorAll('.dash-book-card').forEach(card => {
            card.addEventListener('click', () => openModal({
                cover:  card.dataset.cover,
                titulo: card.dataset.titulo,
                autor:  card.dataset.autor,
                genero: card.dataset.genero,
                precio: card.dataset.precio,
                desc:   card.dataset.desc,
            }));
        });

        /* Botones de corazón: no propagar al card */
        document.querySelectorAll('.dash-wish-btn').forEach(btn => {
            btn.addEventListener('click', e => {
                e.stopPropagation();
                btn.classList.toggle('saved');
                btn.querySelector('i').classList.toggle('bi-heart');
                btn.querySelector('i').classList.toggle('bi-heart-fill');
            });
        });

    });
    </script>

</body>
</html>