<?php

use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream

Route::get('/', function () {
    return view('welcome');
});
=======
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookPublicController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;

/* ── Ruta principal → home ── */
Route::get('/home', [HomeController::class, 'index'])->name('home');

/* ── Búsqueda pública ── */
Route::get('/buscar', [HomeController::class, 'buscar'])->name('buscar');

/* ── Rutas públicas ── */
Route::get('/login',   [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',  [AuthController::class, 'login']);

Route::get('/registro',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/registro', [AuthController::class, 'register']);

/* ── Rutas protegidas — clientes y admins ── */
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /* ── Detalle de libro (público con auth) ── */
    Route::get('/libros/{book}', [BookPublicController::class, 'show'])->name('libros.show');

    /* ── Comentarios ── */
    Route::post('/libros/{book}/comentarios', [CommentController::class, 'store'])->name('comentarios.store');

    /* ── Calificaciones ── */
    Route::post('/libros/{book}/calificaciones', [RatingController::class, 'store'])->name('calificaciones.store');

    /* ── Carrito ── */
    Route::get('/carrito',              [CartController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar/{book}', [CartController::class, 'add'])->name('carrito.add');
    Route::get('/carrito/checkout',     [CartController::class, 'checkout'])->name('carrito.checkout');
    Route::delete('/carrito/vaciar',    [CartController::class, 'clear'])->name('carrito.clear');
    Route::patch('/carrito/{detalle}',  [CartController::class, 'update'])->name('carrito.update');
    Route::delete('/carrito/{detalle}', [CartController::class, 'remove'])->name('carrito.remove');

    /* ── Pagos ── */
    Route::post('/pagar', [PaymentController::class, 'pay'])->name('pagar');
    Route::get('/compra/exitosa', fn() => view('compra-exitosa'))->name('compra.exitosa');

    /* ── Perfil ── */
    Route::get('/perfil',                    [ProfileController::class, 'show'])->name('perfil');
    Route::post('/perfil',                   [ProfileController::class, 'update'])->name('perfil.update');
    Route::post('/perfil/contrasena',        [ProfileController::class, 'changePassword'])->name('perfil.password');
    Route::get('/mis-compras',               [ProfileController::class, 'purchases'])->name('mis-compras');

});

/* ── Rutas de administración — staff (admin + empleado) ── */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    /* ── Autores ── */
    Route::get('/autores',                [AuthorController::class, 'index'])->name('autores.index');
    Route::get('/autores/crear',          [AuthorController::class, 'create'])->name('autores.create');
    Route::post('/autores',               [AuthorController::class, 'store'])->name('autores.store');
    Route::get('/autores/{autor}/editar', [AuthorController::class, 'edit'])->name('autores.edit');
    Route::put('/autores/{autor}',        [AuthorController::class, 'update'])->name('autores.update');
    Route::delete('/autores/{autor}',     [AuthorController::class, 'destroy'])->name('autores.destroy');

    /* ── Categorías ── */
    Route::get('/categorias',                    [CategoryController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/crear',              [CategoryController::class, 'create'])->name('categorias.create');
    Route::post('/categorias',                   [CategoryController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/editar', [CategoryController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}',        [CategoryController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}',     [CategoryController::class, 'destroy'])->name('categorias.destroy');

    /* ── Libros ── */
    Route::get('/libros',               [BookController::class, 'index'])->name('libros.index');
    Route::get('/libros/crear',         [BookController::class, 'create'])->name('libros.create');
    Route::post('/libros',              [BookController::class, 'store'])->name('libros.store');
    Route::get('/libros/{book}',        [BookController::class, 'show'])->name('libros.show');
    Route::get('/libros/{book}/editar', [BookController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{book}',        [BookController::class, 'update'])->name('libros.update');
    Route::post('/libros/{book}/toggle',[BookController::class, 'toggleActivo'])->name('libros.toggle');

    /* ── Secciones solo admin ── */
    Route::middleware('admin.only')->group(function () {
        Route::get('/usuarios', [AdminUserController::class, 'index'])->name('usuarios.index');
        Route::get('/comentarios', [AdminCommentController::class, 'index'])->name('comentarios.index');
        Route::delete('/comentarios/{comment}', [AdminCommentController::class, 'destroy'])->name('comentarios.destroy');
    });

});
>>>>>>> Stashed changes
