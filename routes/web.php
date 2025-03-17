<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\LoginController; // 👈 Agrega esta línea
use App\Http\Controllers\AdminController;







// Route::get('cliente', [PruebaController::class,'cliente'])->name('cliente'); // RUTA DE PRUEBA PARA COMPROBAR VISTA

// Route::get('pedido', [PruebaController::class,'pedido'])->name('pedido'); // RUTA DE PRUEBA PARA COMPROBAR VISTA


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [LoginController::class, 'showLoginForm'])->name('ingresar');



//RUTA DE PRODUCTO
Route::get('producto/vista', [ProductController::class, 'producto'])->name('producto.vista');

Route::resource('producto', ProductController::class);






//RUTAS PROTEGIDAS PARA ADMINISTRADORES
Route::group(['middleware' => ['role:Admin']], function () {

    // Ruta para mostrar el formulario de registro
Route::get('/admin/registrar', [AdminController::class, 'showRegisterForm'])->name('admin.registrar');

// Ruta para procesar el registro de usuario
Route::post('/admin/registrar', [AdminController::class, 'register'])->name('admin.registrar.store');

// Ruta para mostrar usuarios

Route::get('/usuarios', [AdminController::class, 'usersList'])->name('admin.listar');


});