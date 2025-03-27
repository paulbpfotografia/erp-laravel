<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;


  // Ruta Login. Página principal "/"
  Route::get('/', [LoginController::class, 'showLoginForm'])->name('ingresar');

//No eliminar. Con esto se cargan rutas de login y logout
  Auth::routes();


Route::middleware(['auth'])->group(function () {

    // Ruta página home. Página a la que el usuario es redirigido tras el login
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');








    // RUTAS DE PEDIDO
        //Listar pedidos
    Route::get('/pedidos', [OrderController::class, 'index'])
        ->middleware('permission:ver pedidos')->name('pedidos.index');

        //Crear un pedido
        Route::post('/pedidos', [OrderController::class, 'store'])
        ->middleware('permission:crear pedidos')->name('pedidos.store');

        //mostrar página para editar pedidos
    Route::get('/pedidos/{order}/editar', [OrderController::class, 'edit'])
        ->middleware('permission:editar pedidos')->name('pedidos.edit');

        //Mostrar información de un pedido en concreto
    Route::get('/pedidos/{order}', [OrderController::class, 'show'])
        ->middleware('permission:ver pedidos')->name('pedidos.show');

        //Eliminar un pedido
    Route::delete('/pedidos/{order}', [OrderController::class, 'destroy'])
        ->middleware('permission:eliminar pedidos')->name('pedidos.destroy');







    // RUTAS DE PRODUCTO
    //Route::get('/productos', [ProductController::class, 'index'])
    //    ->name('productos.index');
    Route::resource('productos', ProductController::class);
    Route::delete('/productos/{product}', [ProductController::class, 'destroy'])->name('productos.destroy');











    // Rutas Gestión de Usuarios. Protegida para rol ADMIN
    Route::group(['middleware' => ['role:Admin']], function () {
        //Registrar un usuario
        Route::post('/usuarios/registrar', [UserController::class, 'register'])
            ->name('usuarios.registrar.store');
        //Listar usuarios
        Route::get('/usuarios', [UserController::class, 'index'])
            ->name('usuarios.index');
        //Mostrar información sobre un usuario
        Route::get('/usuarios/{user}', [UserController::class, 'show'])
            ->name('usuarios.show');
        //Cambiar columna active de cada usuario para habilitar o deshabilitar
        Route::patch('/usuarios/{user}/active', [UserController::class, 'changeActive'])
            ->name('usuarios.changeActive');
        //Eliminar usuarios
        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])
            ->name('usuarios.destroy');
        //Recuperar vista de formulario para editar usuario
        Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])
            ->name('usuarios.edit');
        //Actualizar usuario
        Route::put('/usuarios/{user}/editar', [UserController::class, 'update'])
            ->name('usuarios.update');
    });



    // RUTA PARA INFORMES (Solo para Directivo)
    Route::get('/informes', function () {
        return view('modulos.informes.informes');
    })->middleware('role:Directivo|Admin')->name('informes.index');


    // Rutas para informes de pedidos (solo para el rol Directivo)
    Route::get('/informes/pedidos', [ReportController::class, 'ordersByMonth'])
    ->middleware('role:Directivo|Admin')
    ->name('informes.pedidos');

});
