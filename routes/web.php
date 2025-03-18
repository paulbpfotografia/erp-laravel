<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\LoginController; // 👈 Agrega esta línea
use App\Http\Controllers\UserController;


Auth::routes();

//Ruta Login. Página principal "/"
Route::get('/', [LoginController::class, 'showLoginForm'])->name('ingresar');

//Ruta página home. Página a la que el usuario es redirigido tras el login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






//RUTA DE PRODUCTO
Route::get('producto/vista', [ProductController::class, 'producto'])->name('producto.vista');

Route::resource('producto', ProductController::class);






//Rutas Gestión de Usuarios del ERP. Protegida para rol ADMIN
Route::group(['middleware' => ['role:Admin']], function () {

    // Ruta para mostrar el formulario de registro
Route::get('/usuarios/registrar', [UserController::class, 'showRegisterForm'])->name('usuarios.registrar');

// Ruta para procesar el registro de usuario
Route::post('/usuarios/registrar', [UserController::class, 'register'])->name('usuarios.registrar.store');

// Ruta para mostrar usuarios
Route::get('/usuarios', [UserController::class, 'usersList'])->name('usuarios.listar');


});
