<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'rol_id'=>1,
            'password' => Hash::make('password'),
            'dni' => '12345678',
            'codigo'=>null,
            'escuela_id'=>null,
            ],
            [
            'id' => 2,
            'name' => 'Escuela',
            'email' => 'escuela@gmail.com',
            'email_verified_at' => now(),
            'rol_id'=>2,
            'password' => Hash::make('password'),
            'dni' => '87654321',
            'codigo'=>null,
            'escuela_id'=>'4SI',
            ],
            [
            'id' => 3,
            'name' => 'Docente',
            'email' => 'docente@gmail.com',
            'email_verified_at' => now(),
            'rol_id'=>3,
            'password' => Hash::make('password'),
            'dni' => '12567834',
            'codigo'=>null,
            'escuela_id'=>null,
            ],
            [
            'id' => 4,
            'name' => 'Alumno',
            'email' => 'alumno@gmail.com',
            'email_verified_at' => now(),
            'rol_id'=>4,
            'password' => Hash::make('password'),
            'dni' => '12367834',
            'codigo'=>'1234567890',
            'escuela_id'=>null,
            ],
            
        ]);
    }
}
