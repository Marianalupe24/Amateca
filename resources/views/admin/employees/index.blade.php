@extends('admin.layout')

@section('title', 'Gestión de Empleados')

@section('content')
<div class="page-header">
    <h1>Gestión de Empleados</h1>
    <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Nuevo Empleado</a>
</div>

<div class="card">
    <form action="{{ route('admin.employees.index') }}" method="GET" style="margin-bottom: 1.5rem; display: flex; gap: 1rem;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, email..." class="form-group" style="padding: .5rem .9rem; border: 1px solid #e0d4d4; border-radius: 6px; width: 300px;">
        <button type="submit" class="btn btn-secondary">Buscar</button>
        @if(request('search'))
            <a href="{{ route('admin.employees.index') }}" class="btn btn-danger">Limpiar</a>
        @endif
    </form>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $emp)
                    <tr>
                        <td>{{ $emp->name }} {{ $emp->apellido }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>{{ $emp->telefono ?? '-' }}</td>
                        <td>{{ $emp->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="td-actions">
                                <a href="{{ route('admin.employees.show', $emp) }}" class="btn btn-sm btn-secondary">Ver</a>
                                <a href="{{ route('admin.employees.edit', $emp) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('admin.employees.destroy', $emp) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar a este empleado?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">No hay empleados registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 1.5rem;">
        {{ $employees->links() }}
    </div>
</div>
@endsection
