
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐈𝐧𝐢𝐜𝐢𝐨 𝐬𝐞𝐬𝐢𝐨́𝐧</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">


</head>
<body>
    <x-loader />
    <div class="main-container">

        <div class="logo">
            <a href="{{ route('home') }}" class="dash-brand">
                <img src="{{ asset('img/logoSinFondo.png') }}" alt="Amateca" class="dash-logo-img">
            </a>
        </div>

        <div class="form-section">
            <div class="form-box">

                <h1>Bienvenido de nuevo</h1>

                @if ($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="field-group">
                        <label for="email">Email:</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Ingrese su correo"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            
                        >
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="password">Contraseña:</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ingrese su contraseña"
                            class="{{ $errors->has('password') ? 'input-error' : '' }}"
                
                        >
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login">
                        Iniciar sesión
                    </button>

                    <p class="register-link">
                        ¿No tienes cuenta? <a href="{{ route('register') }}">Crear cuenta</a>
                    </p>

                </form>
            </div>
        </div>

        <div class="image-section">
            <div class="pink-shape"></div>
            <img src="{{ asset('img/libro.png') }}" alt="Libro con flores" class="book-img">
        </div>


    </div>


</body>
</html>

