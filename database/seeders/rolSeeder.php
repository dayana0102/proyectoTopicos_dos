<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class rolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'nombre' => 'Administrador',
                'estado' => 1,
            ],
            [
                'id' => 2,
                'nombre' => 'Escuela',
                'estado' => 1,
            ],
            [
                'id' => 3,
                'nombre' => 'Docente',
                'estado' => 1,
            ],
            [
                'id'=>4,
                'nombre'=>'Alumno',
                'estado'=>1,
            ]
            
        ]);
    }
}
