<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Administrativo',
                'email' => 'administrativo@administrativo.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Directivo',
                'email' => 'directivo@directivo.com',
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
