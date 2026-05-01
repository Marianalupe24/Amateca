
<<<<<<< HEAD
=======

>>>>>>> vanessa
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝐑𝐞𝐠𝐢𝐬𝐭𝐫𝐨</title>
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/registerView.css') }}">
</head>
<body>

<<<<<<< HEAD
    <x-loader />

    <div class="main-container">

=======

    <x-loader />


    <div class="main-container">


>>>>>>> vanessa
        {{-- Logo arriba a la izquierda --}}
        <div class="logo">
            <img src="{{ asset('img/logoSinFondo.png') }}" alt="Logo Amateca">

<<<<<<< HEAD
        </div>

=======

        </div>


>>>>>>> vanessa
        {{-- ══ LADO IZQUIERDO: Imagen ══ --}}
        <div class="image-section">
            <div class="pink-shape"></div>
            <img src="{{ asset('img/libro.png') }}" alt="Libro con flores" class="book-img">
        </div>

<<<<<<< HEAD
=======

>>>>>>> vanessa
        {{-- ══ LADO DERECHO: Formulario ══ --}}
        <div class="form-section">
            <div class="form-box">

<<<<<<< HEAD
                <h1>Crea una cuenta</h1>

                <form action="{{ route('register') }}" method="POST">
                    @csrf

=======

                <h1>Crea una cuenta</h1>


                <form action="{{ route('register') }}" method="POST">
                    @csrf


>>>>>>> vanessa
                    {{-- Nombre --}}
                    <div class="field-group">
                        <label for="name">Nombre:</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Ingrese su nombre"
                            value="{{ old('name') }}"
                            class="{{ $errors->has('name') ? 'input-error' : '' }}"
                            required
                        >
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

<<<<<<< HEAD
=======

                    {{-- Apellido --}}
                    <div class="field-group">
                        <label for="apellido">Apellido:</label>
                        <input
                            type="text"
                            id="apellido"
                            name="apellido"
                            placeholder="Ingrese su apellido"
                            value="{{ old('apellido') }}"
                            class="{{ $errors->has('apellido') ? 'input-error' : '' }}"
                            required
                        >
                        @error('apellido')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Teléfono --}}
                    <div class="field-group">
                        <label for="telefono">Teléfono: <span style="font-weight:400;font-size:.82em;opacity:.7;">(opcional)</span></label>
                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            placeholder="7890-1234"
                            value="{{ old('telefono') }}"
                            class="{{ $errors->has('telefono') ? 'input-error' : '' }}"
                        >
                        @error('telefono')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>


>>>>>>> vanessa
                    {{-- Correo --}}
                    <div class="field-group">
                        <label for="email">Correo:</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Ingrese su correo"
                            value="{{ old('email') }}"
                            class="{{ $errors->has('email') ? 'input-error' : '' }}"
                            required
                        >
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

<<<<<<< HEAD
=======

>>>>>>> vanessa
                    {{-- Contraseña --}}
                    <div class="field-group">
                        <label for="password">Contraseña:</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Ingrese su contraseña"
                            class="{{ $errors->has('password') ? 'input-error' : '' }}"
                            required
                        >
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

<<<<<<< HEAD
=======

>>>>>>> vanessa
                    {{-- Confirmar contraseña --}}
                    <div class="field-group">
                        <label for="password_confirmation">ConfirmarContraseña:</label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Ingrese su contraseña nuevamente"
                            required
                        >
                    </div>

<<<<<<< HEAD
=======

>>>>>>> vanessa
                    <button type="submit" class="btn-register">
                        Crear cuenta
                    </button>

<<<<<<< HEAD
=======

>>>>>>> vanessa
                    <p class="login-link">
                        ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                    </p>

<<<<<<< HEAD
=======

>>>>>>> vanessa
                </form>
            </div>
        </div>

<<<<<<< HEAD
    </div>

</body>
</html>
=======

    </div>


</body>
</html>

>>>>>>> vanessa
