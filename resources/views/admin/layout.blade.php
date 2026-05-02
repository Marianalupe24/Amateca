<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Amateca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background: #fdf5f5;
            color: #1a1a1a;
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 250px;
            background: #624F4F;
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            box-shadow: 2px 0 8px rgba(0,0,0,.18);
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: .5px;
            color: #FFB2B2;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        .sidebar-brand span { color: #fff; }

        .sidebar-nav {
            padding: 1.5rem 0;
            flex: 1;
        }

        .nav-section {
            margin-bottom: 1.5rem;
        }

        .nav-header {
            padding: 0 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: #FFB2B2;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            opacity: 0.8;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 0.65rem 1.5rem;
            color: #FDE6E6;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.2s, color 0.2s;
            gap: 0.75rem;
            border-left: 4px solid transparent;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.05);
            color: #FFB2B2;
        }
        .nav-item.active {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-left-color: #FFB2B2;
        }
        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* ── Main Content ── */
        .main-content {
            flex: 1;
            margin-left: 250px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: calc(100% - 250px);
        }

        .top-navbar {
            height: 62px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: #624F4F;
        }
        .mobile-toggle svg { width: 24px; height: 24px; }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-left: auto;
        }

        .topbar-logout {
            background: none;
            border: 1.5px solid #e74c3c;
            color: #e74c3c;
            padding: .3rem .9rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: .875rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            transition: background .2s, color .2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .topbar-logout:hover { background: #e74c3c; color: #fff; }

        .main-wrap { max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem; width: 100%; }

        /* Responsive */
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; }
            .mobile-toggle { display: block; }
        }

        /* ── Componentes Globales (Mantenidos) ── */
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .page-header h1 { font-size: 1.5rem; font-weight: 700; color: #624F4F; }

        .alert { padding: .85rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: .875rem; font-weight: 500; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error   { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }

        .card { background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(98,79,79,.1); padding: 1.75rem 2rem; }

        .btn { display: inline-flex; align-items: center; gap: .35rem; padding: .55rem 1.2rem; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: .875rem; font-weight: 600; cursor: pointer; text-decoration: none; border: none; transition: opacity .2s, transform .1s; }
        .btn:active { transform: scale(.97); }
        .btn-primary   { background: #5886B8; color: #fff; }
        .btn-primary:hover   { opacity: .88; }
        .btn-secondary { background: #624F4F; color: #fff; }
        .btn-secondary:hover { opacity: .88; }
        .btn-sm  { padding: .3rem .75rem; font-size: .8rem; }
        .btn-toggle-on  { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .btn-toggle-off { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }
        .btn-toggle-on:hover, .btn-toggle-off:hover { opacity: .85; }
        .btn-danger { background: #e74c3c; color: #fff; }
        .btn-danger:hover { opacity: .88; }
        .btn-danger:disabled { background: #e0d4d4; color: #aaa; cursor: not-allowed; opacity: 1; }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        thead tr { background: #FDE6E6; }
        thead th { padding: .75rem 1rem; text-align: left; font-weight: 600; color: #624F4F; white-space: nowrap; }
        tbody tr { border-bottom: 1px solid #f3eaea; }
        tbody tr:hover { background: #fdf5f5; }
        tbody td { padding: .7rem 1rem; vertical-align: middle; }
        .td-actions { display: flex; gap: .5rem; flex-wrap: wrap; align-items: center; }

        .badge { display: inline-block; padding: .25rem .7rem; border-radius: 20px; font-size: .75rem; font-weight: 600; }
        .badge-active   { background: #d4edda; color: #155724; }
        .badge-inactive { background: #FFB2B2; color: #7a1f1f; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; }
        @media (max-width: 680px) { .form-grid { grid-template-columns: 1fr; } }
        .form-full { grid-column: 1 / -1; }
        .form-group { display: flex; flex-direction: column; gap: .3rem; }
        .form-group label { font-size: .85rem; font-weight: 600; color: #624F4F; }
        .form-group input, .form-group select { padding: .6rem .9rem; border: 1.5px solid #e0d4d4; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: .875rem; color: #1a1a1a; outline: none; transition: border-color .2s; background: #fff; }
        .form-group input:focus, .form-group select:focus { border-color: #5886B8; }
        .form-error { color: #c0392b; font-size: .78rem; margin-top: .15rem; }
        .form-actions { display: flex; gap: 1rem; margin-top: 1.75rem; padding-top: 1.5rem; border-top: 1px solid #f3eaea; }

        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem 2rem; }
        @media (max-width: 680px) { .detail-grid { grid-template-columns: 1fr; } }
        .detail-full { grid-column: 1 / -1; }
        .detail-item label { display: block; font-size: .78rem; font-weight: 600; color: #624F4F; text-transform: uppercase; letter-spacing: .5px; margin-bottom: .3rem; }
        .detail-item p { font-size: .95rem; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">Amate<span>ca</span> Admin</a>
    
    <nav class="sidebar-nav">
        <!-- GENERAL -->
        <div class="nav-section">
            <div class="nav-header">General</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
        </div>

        <!-- CATÁLOGO -->
        <div class="nav-section">
            <div class="nav-header">Catálogo</div>
            <a href="{{ route('admin.libros.index') }}" class="nav-item {{ request()->routeIs('admin.libros.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Productos
            </a>
            <a href="{{ route('admin.categorias.index') }}" class="nav-item {{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Categorías
            </a>
            <a href="{{ route('admin.autores.index') }}" class="nav-item {{ request()->routeIs('admin.autores.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Autores
            </a>
        </div>

        <!-- VENTAS -->
        <div class="nav-section">
            <div class="nav-header">Ventas</div>
            {{-- pendiente: ruta de pedidos no identificada claramente en el listado, se asume pendiente si no existe un orders.index --}}
            {{-- <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Pedidos
            </a> --}}
            <a href="{{ route('admin.sales-report') }}" class="nav-item {{ request()->routeIs('admin.sales-report') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Reporte de ventas
            </a>
        </div>

        <!-- PERSONAS -->
        @if(Auth::user()->isAdmin())
        <div class="nav-section">
            <div class="nav-header">Personas</div>
            <a href="{{ route('admin.employees.index') }}" class="nav-item {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Empleados
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="nav-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Clientes
            </a>
            <a href="{{ route('admin.comentarios.index') }}" class="nav-item {{ request()->routeIs('admin.comentarios.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                Comentarios
            </a>
        </div>
        @endif
        
    </nav>
</aside>

<!-- CONTENIDO PRINCIPAL -->
<main class="main-content">
    <nav class="top-navbar">
        <button class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        
        <div class="topbar-actions">
            <a href="{{ route('home') }}" style="color: #5886B8; text-decoration: none; font-size: 0.875rem; font-weight: 600;">Ver Tienda</a>
            
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="topbar-logout">
                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </nav>

    <div class="main-wrap">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</main>

</body>
</html>
