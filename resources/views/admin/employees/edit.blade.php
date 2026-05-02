@extends('admin.layout')

@section('title', 'Editar Empleado')

@section('content')
<div class="page-header">
    <h1>Editar Empleado: {{ $employee->name }}</h1>
    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Volver</a>
</div>

<div class="card">
    <form action="{{ route('admin.employees.update', $employee) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" value="{{ old('apellido', $employee->apellido) }}">
                @error('apellido') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $employee->telefono) }}">
                @error('telefono') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group form-full">
                <hr style="border: 0; border-top: 1px solid #f3eaea; margin: 1rem 0;">
                <p style="font-size: 0.85rem; color: #624F4F;">Dejar en blanco si no deseas cambiar la contraseña.</p>
            </div>

            <div class="form-group">
                <label for="password">Nueva Contraseña</label>
                <input type="password" name="password" id="password">
                @error('password') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Actualizar Empleado</button>
        </div>
    </form>
</div>
@endsection
