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
            flex-direction: column;
        }
        .main-wrap { flex: 1; }

        /* ── Topbar ── */
        .topbar {
            background: #624F4F;
            color: #fff;
            padding: 0 2rem;
            height: 62px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,.18);
        }
        .topbar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: .5px;
            color: #FFB2B2;
            text-decoration: none;
        }
        .topbar-brand span { color: #fff; }
        .topbar-nav { display: flex; gap: 1.5rem; align-items: center; }
        .topbar-nav a {
            color: #FDE6E6;
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            transition: color .2s;
        }
        .topbar-nav a:hover { color: #FFB2B2; }
        .topbar-logout {
            background: none;
            border: 1.5px solid #FFB2B2;
            color: #FFB2B2;
            padding: .3rem .9rem;
            border-radius: 6px;
            cursor: pointer;
            font-size: .875rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            transition: background .2s, color .2s;
        }
        .topbar-logout:hover { background: #FFB2B2; color: #624F4F; }

        /* ── Layout ── */
        .main-wrap { max-width: 1200px; margin: 0 auto; padding: 2rem 1.5rem; }

        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .page-header h1 { font-size: 1.5rem; font-weight: 700; color: #624F4F; }

        /* ── Alerts ── */
        .alert {
            padding: .85rem 1.2rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: .875rem;
            font-weight: 500;
        }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error   { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }

        /* ── Card ── */
        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(98,79,79,.1);
            padding: 1.75rem 2rem;
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .55rem 1.2rem;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: .875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: opacity .2s, transform .1s;
        }
        .btn:active { transform: scale(.97); }
        .btn-primary   { background: #5886B8; color: #fff; }
        .btn-primary:hover   { opacity: .88; }
        .btn-secondary { background: #624F4F; color: #fff; }
        .btn-secondary:hover { opacity: .88; }
        .btn-sm  { padding: .3rem .75rem; font-size: .8rem; }
        .btn-toggle-on  { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .btn-toggle-off { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }
        .btn-toggle-on:hover,
        .btn-toggle-off:hover { opacity: .85; }
        .btn-danger { background: #e74c3c; color: #fff; }
        .btn-danger:hover { opacity: .88; }
        .btn-danger:disabled { background: #e0d4d4; color: #aaa; cursor: not-allowed; opacity: 1; }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        thead tr { background: #FDE6E6; }
        thead th {
            padding: .75rem 1rem;
            text-align: left;
            font-weight: 600;
            color: #624F4F;
            white-space: nowrap;
        }
        tbody tr { border-bottom: 1px solid #f3eaea; }
        tbody tr:hover { background: #fdf5f5; }
        tbody td { padding: .7rem 1rem; vertical-align: middle; }
        .td-actions { display: flex; gap: .5rem; flex-wrap: wrap; align-items: center; }

        /* ── Badge ── */
        .badge {
            display: inline-block;
            padding: .25rem .7rem;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
        }
        .badge-active   { background: #d4edda; color: #155724; }
        .badge-inactive { background: #FFB2B2; color: #7a1f1f; }

        /* ── Forms ── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }
        @media (max-width: 680px) { .form-grid { grid-template-columns: 1fr; } }
        .form-full { grid-column: 1 / -1; }
        .form-group { display: flex; flex-direction: column; gap: .3rem; }
        .form-group label { font-size: .85rem; font-weight: 600; color: #624F4F; }
        .form-group input,
        .form-group select {
            padding: .6rem .9rem;
            border: 1.5px solid #e0d4d4;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: .875rem;
            color: #1a1a1a;
            outline: none;
            transition: border-color .2s;
            background: #fff;
        }
        .form-group input:focus,
        .form-group select:focus { border-color: #5886B8; }
        .form-error { color: #c0392b; font-size: .78rem; margin-top: .15rem; }
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.75rem;
            padding-top: 1.5rem;
            border-top: 1px solid #f3eaea;
        }

        /* ── Detail grid ── */
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem 2rem; }
        @media (max-width: 680px) { .detail-grid { grid-template-columns: 1fr; } }
        .detail-full { grid-column: 1 / -1; }
        .detail-item label {
            display: block;
            font-size: .78rem;
            font-weight: 600;
            color: #624F4F;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin-bottom: .3rem;
        }
        .detail-item p { font-size: .95rem; }
    </style>
</head>
<body>

<nav class="topbar">
    <a href="{{ route('admin.libros.index') }}" class="topbar-brand">Amate<span>ca</span> Admin</a>
    <div class="topbar-nav">
        <a href="{{ route('admin.libros.index') }}">Libros</a>
        <a href="{{ route('admin.autores.index') }}">Autores</a>
        <a href="{{ route('admin.categorias.index') }}">Categorías</a>
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.usuarios.index') }}">Usuarios</a>
            <a href="{{ route('admin.comentarios.index') }}">Comentarios</a>
        @endif
        <a href="{{ route('home') }}">Ver tienda</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="topbar-logout">Cerrar sesión</button>
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

</body>
</html>
