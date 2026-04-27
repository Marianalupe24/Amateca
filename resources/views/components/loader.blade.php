{{-- CSS inline justo antes del loader para evitar pantalla blanca --}}
<style>
    /* Estilos críticos inline para que el loader aparezca inmediatamente */
    #loader-overlay {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff0f4;
    }
    .book {
        position: relative;
        width: 160px;
        height: 100px;
        perspective: 1000px;
        margin: 0 auto 30px;
        opacity: 1;
        visibility: visible;
    }
    .loading-text {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        font-size: 22px;
        font-weight: 500;
        color: #555;
        opacity: 1;
        visibility: visible;
    }
</style>

<div id="loader-overlay">
    <div class="loader-container">
        <div class="book">
            <div class="cover left"></div>
            <div class="page p1"></div>
            <div class="page p2"></div>
            <div class="page p3"></div>
            <div class="cover right"></div>
            <div class="spine"></div>
        </div>

        <div class="loading-text">
            <img src="{{ asset('img/florSinFondo.png') }}" class="loader-icon" alt="">
            <span class="letters">
                <span>C</span><span>a</span><span>r</span><span>g</span><span>a</span><span>n</span><span>d</span><span>o</span>
                <span>.</span><span>.</span><span>.</span>
            </span>
        </div>
    </div>
</div>

{{-- CSS completo con animaciones --}}
<link rel="stylesheet" href="{{ asset('css/loader.css') }}">
<link rel="icon" href="{{ asset('img/florSinFondo.png') }}">


<script>
    // Espera a que la página cargue completamente y luego oculta el loader
    window.addEventListener('load', function () {
        setTimeout(function () {
            var overlay = document.getElementById('loader-overlay');
            if (overlay) {
                overlay.classList.add('loader-hidden');
                setTimeout(function () { 
                    if (overlay && overlay.parentNode) {
                        overlay.remove(); 
                    }
                }, 650);
            }
        }, 2500); // El loader se oculta después de 2.5 segundos
    });
</script>