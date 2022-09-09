<?php

namespace Database\Seeders;

use App\Models\Zona;
use Illuminate\Database\Seeder;

class ZonasTableSeeder extends Seeder
{
    public function run()
    {
        $zonas = [
            [
                'id'             => 1,
                'nombre'           => 'Morelos Norte',
                'descripcion'           => 'Municipios del norte de Morelos',
                'entidad'           => 'Morelos',
                'estatus' => 'Activo',
            ],
            [
                'id'             => 2,
                'nombre'           => 'EdoMex',
                'descripcion'           => 'Municipios del Estado de México',
                'entidad'           => 'Estado de México',
                'estatus' => 'Activo',
            ],
        ];

        Zona::insert($zonas);
    }
}
