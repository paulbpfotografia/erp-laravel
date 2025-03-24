<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('provinces')->insert([
            ['name' => 'Álava'], ['name' => 'Albacete'], ['name' => 'Alicante'],
            ['name' => 'Almería'], ['name' => 'Asturias'], ['name' => 'Ávila'],
            ['name' => 'Badajoz'], ['name' => 'Barcelona'], ['name' => 'Burgos'],
            ['name' => 'Cáceres'], ['name' => 'Cádiz'], ['name' => 'Cantabria'],
            ['name' => 'Castellón'], ['name' => 'Ciudad Real'], ['name' => 'Córdoba'],
            ['name' => 'Cuenca'], ['name' => 'Girona'], ['name' => 'Granada'],
            ['name' => 'Guadalajara'], ['name' => 'Guipúzcoa'], ['name' => 'Huelva'],
            ['name' => 'Huesca'], ['name' => 'Illes Balears'], ['name' => 'Jaén'],
            ['name' => 'La Coruña'], ['name' => 'La Rioja'], ['name' => 'Las Palmas'],
            ['name' => 'León'], ['name' => 'Lleida'], ['name' => 'Lugo'],
            ['name' => 'Madrid'], ['name' => 'Málaga'], ['name' => 'Murcia'],
            ['name' => 'Navarra'], ['name' => 'Ourense'], ['name' => 'Palencia'],
            ['name' => 'Pontevedra'], ['name' => 'Salamanca'], ['name' => 'Santa Cruz de Tenerife'],
            ['name' => 'Segovia'], ['name' => 'Sevilla'], ['name' => 'Soria'],
            ['name' => 'Tarragona'], ['name' => 'Teruel'], ['name' => 'Toledo'],
            ['name' => 'Valencia'], ['name' => 'Valladolid'], ['name' => 'Vizcaya'],
            ['name' => 'Zamora'], ['name' => 'Zaragoza'],
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
