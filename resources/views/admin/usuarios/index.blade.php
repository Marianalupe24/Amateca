@extends('admin.layout')

@section('title', 'Usuarios')

@section('content')
<div class="page-header">
    <h1>Usuarios registrados</h1>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>
                        <strong>{{ $usuario->name }} {{ $usuario->apellido }}</strong>
                    </td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefono ?? '—' }}</td>
                    <td>
                        @if($usuario->rol === 'admin')
                            <span class="badge" style="background:#624F4F;color:#fff;">Admin</span>
                        @elseif($usuario->rol === 'empleado')
                            <span class="badge" style="background:#5886B8;color:#fff;">Empleado</span>
                        @else
                            <span class="badge badge-active">Cliente</span>
                        @endif
                    </td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#888;padding:2rem 0;">
                        No hay usuarios registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
