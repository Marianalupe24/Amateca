<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function show()
    {
        return view('perfil', ['user' => Auth::user()]);
    }


    public function update(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'name'     => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ], [
            'name.required'     => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
        ]);


        $user->update($request->only('name', 'apellido', 'telefono'));


        return back()->with('success', 'Perfil actualizado correctamente.');
    }


    public function changePassword(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'La contraseña actual es obligatoria.',
            'password.required'         => 'La nueva contraseña es obligatoria.',
            'password.min'              => 'La nueva contraseña debe tener al menos 8 caracteres.',
            'password.confirmed'        => 'Las contraseñas no coinciden.',
        ]);


        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.'])
                         ->with('tab', 'password');
        }


        $user->update(['password' => Hash::make($request->password)]);


        return back()->with('success', 'Contraseña actualizada correctamente.')->with('tab', 'password');
    }


    public function purchases()
    {
        $facturas = Auth::user()
            ->facturas()
            ->with('detalles.book')
            ->where('estado', 'pagado')
            ->orderByDesc('created_at')
            ->get();


        return view('mis-compras', compact('facturas'));
    }
}



