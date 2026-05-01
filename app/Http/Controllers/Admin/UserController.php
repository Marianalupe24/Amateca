<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::orderByDesc('created_at')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }
}
