<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amateca - Crear cuenta</title>
    <link rel="stylesheet" href="{{ asset('css/registerView.css') }}" >
</head>
<body>

<div class="container">

    <!-- PANEL IZQUIERDO -->
    <div class="left-panel">
        <div class="logo">
            <!-- Ícono libro SVG simple -->
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 6C8 6 14 4 20 8C26 4 32 6 32 6V32C32 32 26 30 20 34C14 30 8 32 8 32V6Z"
                      fill="#c0474a" opacity="0.85"/>
                <path d="M20 8V34" stroke="#fff" stroke-width="1.2"/>
                <!-- Hoja decorativa -->
                <path d="M20 10C20 10 16 6 13 8C16 9 20 14 20 14" fill="#e8908e"/>
                <path d="M20 10C20 10 24 6 27 8C24 9 20 14 20 14" fill="#e8908e"/>
            </svg>
            <span>AMATECA</span>
        </div>

        <!-- Imagen de flores sobre libro -->
        <img
            src="{{ asset('../img/flower-book.png') }}"
            alt="Libro con flores"
            class="flower-img"
            onerror="this.style.display='none'"
        />
    </div>

    <!-- PANEL DERECHO -->
    <div class="right-panel">
        <h1>Crea una cuenta</h1>

        <form action="{{ route('register') }}" method="POST" style="width: 100%;">
            @csrf

            <!-- Nombre -->
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Ingrese su nombre"
                    value="{{ old('name') }}"
                    class="{{ $errors->has('name') ? 'input-error' : '' }}"
                    required
                />
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Correo -->
            <div class="form-group">
                <label for="email">Correo:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Ingrese su correo"
                    value="{{ old('email') }}"
                    class="{{ $errors->has('email') ? 'input-error' : '' }}"
                    required
                />
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Ingrese su contraseña"
                    class="{{ $errors->has('password') ? 'input-error' : '' }}"
                    required
                />
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Ingrese su contraseña nuevamente"
                    required
                />
            </div>

            <!-- Botón -->
            <div style="display: flex; justify-content: center;">
                <button type="submit" class="btn-crear">Crear cuenta</button>
            </div>

            <!-- Link a login -->
            <div style="text-align: center;">
                <p class="login-link">
                   ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                </p>
            </div>

        </form>
    </div>

</div>

</body>
</html>