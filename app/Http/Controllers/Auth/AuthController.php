<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ── REGISTRO ── */


    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->isStaff()
                ? redirect()->route('admin.libros.index')
                : redirect()->route('dashboard');
        }
        return view('register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'apellido'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'telefono'  => 'nullable|string|max:20',
            'password'  => 'required|min:8|confirmed',
        ], [
            'name.required'      => 'El nombre es obligatorio.',
            'apellido.required'  => 'El apellido es obligatorio.',
            'email.required'     => 'El correo es obligatorio.',
            'email.email'        => 'El correo no tiene un formato válido.',
            'email.unique'       => 'Este correo ya está registrado.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.min'       => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);


        $user = User::create([
            'name'     => $request->name,
            'apellido' => $request->apellido,
            'email'    => $request->email,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
            'rol'      => 'cliente',
        ]);


        Auth::login($user);


        return redirect()->route('dashboard');
    }


    /* ── LOGIN ── */


    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->isStaff()
                ? redirect()->route('admin.libros.index')
                : redirect()->route('dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'El correo es obligatorio.',
            'email.email'       => 'El correo no tiene un formato válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);


        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();


            if ($user->isStaff()) {
                return redirect()->intended(route('admin.libros.index'));
            }


            return redirect()->intended(route('dashboard'));
        }


        return back()->withErrors([
            'email' => 'El correo o la contraseña son incorrectos.',
        ])->onlyInput('email');
    }


    /* ── LOGOUT ── */


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}



