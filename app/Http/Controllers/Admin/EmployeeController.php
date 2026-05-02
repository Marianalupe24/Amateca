<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = User::employees();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('apellido', 'like', "%{$search}%");
            });
        }

        $employees = $query->latest()->paginate(15);

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'telefono' => ['nullable', 'string', 'max:20'],
        ]);

        User::create([
            'name'     => $request->name,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'rol'      => 'empleado',
        ]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Empleado creado exitosamente.');
    }

    public function show(User $employee)
    {
        if (!$employee->isEmpleado()) {
            abort(404);
        }

        return view('admin.employees.show', compact('employee'));
    }

    public function edit(User $employee)
    {
        if (!$employee->isEmpleado()) {
            abort(404);
        }

        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        if (!$employee->isEmpleado()) {
            abort(404);
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'apellido' => ['nullable', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($employee->id)],
            'telefono' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $data = $request->only('name', 'apellido', 'email', 'telefono');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    public function destroy(User $employee)
    {
        if (!$employee->isEmpleado()) {
            abort(404);
        }

        // Hard delete o soft delete si aplica
        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success', 'Empleado eliminado exitosamente.');
    }
}
