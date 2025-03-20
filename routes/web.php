<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

  // Ruta Login. Página principal "/"
  Route::get('/', [LoginController::class, 'showLoginForm'])->name('ingresar');

//No eliminar. Con esto se cargan rutas de login y logout
  Auth::routes();
  

Route::middleware(['auth'])->group(function () {

    // Ruta página home. Página a la que el usuario es redirigido tras el login
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // RUTA DE PEDIDO
    Route::get('/pedidos', [OrderController::class, 'index'])
        ->middleware('permission:ver pedidos')->name('pedidos.index');

    Route::get('/pedidos/{id}/editar', [OrderController::class, 'edit'])
        ->middleware('permission:editar pedidos')->name('pedidos.edit');

    Route::get('/pedidos/{order}', [OrderController::class, 'show'])
        ->middleware('permission:ver pedidos')->name('pedidos.show');

    Route::delete('/pedidos/{order}', [OrderController::class, 'destroy'])
        ->middleware('permission:eliminar pedidos')->name('pedidos.destroy');

    // RUTA DE PRODUCTO
    Route::get('/productos', [ProductController::class, 'index'])
        ->name('productos.index');

    // Rutas Gestión de Usuarios del ERP. Protegida para rol ADMIN
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::post('/usuarios/registrar', [UserController::class, 'register'])
            ->name('usuarios.registrar.store');

        Route::get('/usuarios', [UserController::class, 'index'])
            ->name('usuarios.index');

        Route::get('/usuarios/{user}', [UserController::class, 'show'])
            ->name('usuarios.show');

        Route::patch('/usuarios/{user}/active', [UserController::class, 'changeActive'])
            ->name('usuarios.changeActive');

        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])
            ->name('usuarios.destroy');

        Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])
            ->name('usuarios.edit');

        Route::put('/usuarios/{user}/editar', [UserController::class, 'update'])
            ->name('usuarios.update');
    });

});
