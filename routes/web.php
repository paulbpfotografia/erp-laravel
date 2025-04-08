<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderLogisticsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReportController;


// Ruta Login. Página principal "/"
Route::get('/', [LoginController::class, 'showLoginForm'])->name('ingresar');

Route::get('/contact', function () {
    // Retornamos la vista "modulos.contacto.contact"
    return view('modulos.contacto.contact');
})->name('contact');

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



    // Grupo de rutas para Productos, protegidas por permisos
    Route::group(['prefix' => 'productos', 'as' => 'productos.'], function () {
        // Listar productos
        Route::get('/', [ProductController::class, 'index'])
            ->middleware('permission:ver productos')
            ->name('index');

        // Form para crear producto
        Route::get('/create', [ProductController::class, 'create'])
            ->middleware('permission:crear productos')
            ->name('create');

        // Guardar producto (POST)
        Route::post('/', [ProductController::class, 'store'])
            ->middleware('permission:crear productos')
            ->name('store');

        // Mostrar producto individual
        Route::get('/{product}', [ProductController::class, 'show'])
            ->middleware('permission:ver productos')
            ->name('show');

        // Form para editar producto
        Route::get('/{product}/edit', [ProductController::class, 'edit'])
            ->middleware('permission:editar productos')
            ->name('edit');

        // Actualizar producto (PUT/PATCH)
        Route::put('/{product}', [ProductController::class, 'update'])
            ->middleware('permission:editar productos')
            ->name('update');

        // Eliminar producto
        Route::delete('/{product}', [ProductController::class, 'destroy'])
            ->middleware('permission:eliminar productos')
            ->name('destroy');
    });


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





    //RUTAS DE LOGÍSTICA Y ALMACÉN

    // Rutas Gestión de Usuarios. Protegida para rol ADMIN
    Route::group(['middleware' => ['role:Logistica|Admin']], function () {
        //Listar usuarios
        Route::get('/logistica', [OrderLogisticsController::class, 'index'])->name('logistica.index');

        //Acceder a un pedido concreto
        Route::get('/logistica/{order}', [OrderLogisticsController::class, 'show'])->name('logistica.show');

    });
});
