<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\LoginController; // 👈 Agrega esta línea







// Route::get('cliente', [PruebaController::class,'cliente'])->name('cliente'); // RUTA DE PRUEBA PARA COMPROBAR VISTA

// Route::get('pedido', [PruebaController::class,'pedido'])->name('pedido'); // RUTA DE PRUEBA PARA COMPROBAR VISTA


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [LoginController::class, 'showLoginForm'])->name('ingresar');



//RUTA DE PRODUCTO
Route::get('producto/vista', [ProductController::class, 'producto'])->name('producto.vista');

Route::resource('producto', ProductController::class);

