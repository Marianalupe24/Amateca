<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil — Amateca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/florSinFondo.png') }}">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #fdf5f5; display: flex; flex-direction: column; min-height: 100vh; }
        .profile-wrap { max-width: 720px; margin: 2.5rem auto; padding: 0 1.5rem; flex: 1; }
        .page-title { font-size: 1.5rem; font-weight: 700; color: #624F4F; margin-bottom: 1.75rem; }
        .profile-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 12px rgba(98,79,79,.1); padding: 2rem; margin-bottom: 1.5rem; }
        .section-label { font-weight: 700; color: #624F4F; font-size: 1rem; margin-bottom: 1.25rem; display: flex; align-items: center; gap: .5rem; border-bottom: 2px solid #FDE6E6; padding-bottom: .6rem; }
        .form-label-sm { font-size: .8rem; font-weight: 600; color: #624F4F; }
        .form-control { border: 1.5px solid #e0d4d4; border-radius: 8px; font-family: 'Poppins', sans-serif; font-size: .875rem; }
        .form-control:focus { border-color: #5886B8; box-shadow: none; }
        .form-control:disabled, .form-control[readonly] { background: #f8f4f4; color: #888; }
        .btn-save { background: #5886B8; color: #fff; border: none; border-radius: 8px; padding: .6rem 1.75rem; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: .875rem; transition: opacity .2s; }
        .btn-save:hover { opacity: .88; }
        .alert-flash { border-radius: 8px; padding: .75rem 1rem; margin-bottom: 1rem; font-size: .875rem; font-weight: 500; }
        .alert-flash.success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-flash.error   { background: #FFB2B2; color: #7a1f1f; border: 1px solid #f5a0a0; }
        .tabs { display: flex; gap: 0; border-bottom: 2px solid #FDE6E6; margin-bottom: 1.5rem; }
        .tab-btn { background: none; border: none; padding: .65rem 1.25rem; font-family: 'Poppins', sans-serif; font-size: .875rem; font-weight: 600; color: #888; cursor: pointer; border-bottom: 3px solid transparent; margin-bottom: -2px; transition: color .2s, border-color .2s; }
        .tab-btn.active { color: #5886B8; border-bottom-color: #5886B8; }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body>
<x-loader />
<x-navbar />


<div class="profile-wrap">
    <h1 class="page-title"><i class="bi bi-person-circle me-2"></i>Mi Perfil</h1>


    @if(session('success'))
        <div class="alert-flash success">{{ session('success') }}</div>
    @endif


    <div class="profile-card">
        <div class="tabs">
            <button class="tab-btn {{ session('tab') === 'password' ? '' : 'active' }}" data-tab="datos">
                <i class="bi bi-person me-1"></i>Datos personales
            </button>
            <button class="tab-btn {{ session('tab') === 'password' ? 'active' : '' }}" data-tab="password">
                <i class="bi bi-shield-lock me-1"></i>Contraseña
            </button>
        </div>


        {{-- Tab: Datos personales --}}
        <div class="tab-content {{ session('tab') === 'password' ? '' : 'active' }}" id="tab-datos">
            <form action="{{ route('perfil.update') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-sm-6">
                        <label class="form-label form-label-sm">Nombre</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 col-sm-6">
                        <label class="form-label form-label-sm">Apellido</label>
                        <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror"
                               value="{{ old('apellido', $user->apellido) }}" required>
                        @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label form-label-sm">Correo electrónico</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        <div class="form-text" style="font-size:.75rem;color:#888;">El correo no se puede modificar.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label form-label-sm">Teléfono <span style="font-weight:400;opacity:.7;">(opcional)</span></label>
                        <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                               value="{{ old('telefono', $user->telefono) }}" placeholder="7890-1234">
                        @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12 mt-1">
                        <button type="submit" class="btn-save">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>


        {{-- Tab: Contraseña --}}
        <div class="tab-content {{ session('tab') === 'password' ? 'active' : '' }}" id="tab-password">
            <form action="{{ route('perfil.password') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label form-label-sm">Contraseña actual</label>
                        <input type="password" name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label form-label-sm">Nueva contraseña</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label form-label-sm">Confirmar nueva contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                    <div class="col-12 mt-1">
                        <button type="submit" class="btn-save">Cambiar contraseña</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<x-footer />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        btn.classList.add('active');
        document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
    });
});
</script>
</body>
</html>



