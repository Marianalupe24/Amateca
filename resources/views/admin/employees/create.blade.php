@extends('admin.layout')

@section('title', 'Nuevo Empleado')

@section('content')
<div class="page-header">
    <h1>Nuevo Empleado</h1>
    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <form action="{{ route('admin.employees.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}">
                @error('apellido') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}">
                @error('telefono') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Guardar Empleado</button>
        </div>
    </form>
</div>
@endsection
