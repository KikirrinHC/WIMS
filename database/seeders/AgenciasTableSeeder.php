<?php

namespace Database\Seeders;

use App\Models\Agencium;
use Illuminate\Database\Seeder;

class AgenciasTableSeeder extends Seeder
{
    public function run()
    {
        $agencias = [
            [
                'id'             => 1,
                'nombre'           => 'Cometra',
                'estatus' => 'Activo',
                'empresa_id' => '1',
            ],
            [
                'id'             => 2,
                'nombre'           => 'Sepsa',
                'estatus' => 'Activo',
                'empresa_id' => '1',
            ],
        ];

        Agencium::insert($agencias);
    }
}
