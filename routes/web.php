<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;

Route::get('/', function () { return view('welcome'); });




Route::get('producto', [PruebaController::class,'producto'])->name('producto'); // RUTA DE PRUEBA PARA COMPROBAR VISTA

Route::get('cliente', [PruebaController::class,'cliente'])->name('cliente'); // RUTA DE PRUEBA PARA COMPROBAR VISTA

Route::get('pedido', [PruebaController::class,'pedido'])->name('pedido'); // RUTA DE PRUEBA PARA COMPROBAR VISTA


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
