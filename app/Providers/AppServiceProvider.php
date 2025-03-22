<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    
    
    public function boot(): void
    {
        $publicStoragePath = public_path('storage');
    
        // Si el enlace simbólico no existe, lo creamos
        if (!File::exists($publicStoragePath)) {
            Artisan::call('storage:link');
        }
    }
    

}