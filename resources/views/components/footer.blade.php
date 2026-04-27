{{--
    COMPONENTE FOOTER
    Ubicación: resources/views/components/footer.blade.php

    Uso en cualquier blade:
       
--}}

<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<link rel="icon" href="{{ asset('img/florSinFondo.png') }}">

<footer class="site-footer">

    {{-- Logo centrado que sube sobre el footer --}}
    <div class="footer-logo">
        <img src="{{ asset('img/logoSinFondo.png') }}" alt="Logo Amateca">
    </div>

    {{-- Fila principal con links a los lados y logo en el centro --}}
    <div class="footer-main">
        <div class="footer-left">
            <a href="#">Contactos</a>
        </div>

        {{-- Espacio vacío para que el logo del centro no tape el texto --}}
        <div class="footer-center-spacer"></div>

        <div class="footer-right">
            <a href="#">Navegación</a>
        </div>
    </div>

    {{-- Línea de copyright --}}
    <div class="footer-copy">
        &copy; Amateca &ndash; Licencia CC BY-NC
    </div>

</footer>