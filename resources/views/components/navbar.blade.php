{{--
    NAVBAR DEL DASHBOARD
    Ubicación: pégalo dentro de resources/views/dashboard.blade.php
    reemplazando todo el bloque <nav class="dash-navbar"...> que tenías.
    
    También reemplaza el bloque .dash-navbar en dashboard.css
    con el CSS de navbar.css que te genero aparte.
--}}

{{-- Fuentes necesarias --}}
<link href="https://fonts.googleapis.com/css2?family=Italiana&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

 {{-- ============================================================
         NAVBAR
    ============================================================ --}}
    <nav class="dash-navbar" id="dashNav">
        <div class="dash-nav-inner">

            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" class="dash-brand">
                <img src="{{ asset('img/logoSinFondo.png') }}" alt="Amateca" class="dash-logo-img">
                <span class="dash-brand-name">AMATECA</span>
            </a>

            {{-- Buscador --}}
            <form action="{{ route('buscar') }}" method="GET" class="dash-search-wrap" style="display:flex;align-items:center;">
                <i class="bi bi-search dash-search-icon"></i>
                <input type="text" name="q" class="dash-search"
                       value="{{ request('q') }}"
                       placeholder="Buscar libros, autores, géneros..."
                       autocomplete="off">
            </form>

            {{-- Acciones --}}
            <div class="dash-nav-actions">
                @if(Auth::user()->isStaff())
                    <a href="{{ route('admin.libros.index') }}" class="dash-icon-btn" title="Panel Admin" style="text-decoration:none;">
                        <i class="bi bi-shield-check"></i>
                    </a>
                @endif
                <a href="{{ route('carrito.index') }}" class="dash-icon-btn" title="Carrito" style="text-decoration:none;position:relative;">
                    <i class="bi bi-bag"></i>
                    @php
                        $cartCount = Auth::user()->cart?->details()->sum('cantidad') ?? 0;
                    @endphp
                    @if($cartCount > 0)
                        <span class="dash-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                {{-- Avatar / menú usuario --}}
                <div class="dash-avatar-wrap" id="avatarWrap">
                    <button class="dash-avatar" id="avatarBtn">
                        <i class="bi bi-person-fill"></i>
                    </button>
                    <div class="dash-dropdown" id="avatarDropdown">
                        <p class="dash-dropdown-name">{{ Auth::user()->name }}</p>
                        <a href="{{ route('perfil') }}" class="dash-dropdown-item"><i class="bi bi-person"></i> Mi perfil</a>
                        <a href="{{ route('mis-compras') }}" class="dash-dropdown-item"><i class="bi bi-clock-history"></i> Mis compras</a>
                        <div class="dash-dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dash-dropdown-item dash-logout">
                                <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </nav>