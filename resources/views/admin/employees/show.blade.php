@extends('admin.layout')

@section('title', 'Detalle de Empleado')

@section('content')
<div class="page-header">
    <h1>Detalle de Empleado: {{ $employee->name }}</h1>
    <div>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-primary">Editar</a>
    </div>
</div>

<div class="card">
    <div class="detail-grid">
        <div class="detail-item">
            <label>Nombre</label>
            <p>{{ $employee->name }}</p>
        </div>
        <div class="detail-item">
            <label>Apellido</label>
            <p>{{ $employee->apellido ?? 'N/A' }}</p>
        </div>
        <div class="detail-item">
            <label>Email</label>
            <p>{{ $employee->email }}</p>
        </div>
        <div class="detail-item">
            <label>Teléfono</label>
            <p>{{ $employee->telefono ?? 'N/A' }}</p>
        </div>
        <div class="detail-item">
            <label>Fecha de Registro</label>
            <p>{{ $employee->created_at->format('d/m/Y H:i') }}</p>
        </div>
        <div class="detail-item">
            <label>Rol</label>
            <p><span class="badge badge-active">{{ ucfirst($employee->rol) }}</span></p>
        </div>
    </div>
</div>
@endsection
