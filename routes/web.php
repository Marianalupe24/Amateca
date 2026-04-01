<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

// Mostrar formulario de registro
Route::get('/registro', [AuthController::class, 'showRegister'])->name('register');

// Procesar el formulario
Route::post('/registro', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');