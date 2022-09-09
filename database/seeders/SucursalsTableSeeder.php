<?php

namespace Database\Seeders;

use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class SucursalsTableSeeder extends Seeder
{
    public function run()
    {
        $sucursals = [
            [
                'id'             => 1,
                'nombre'           => 'Cometra Norte',
                'entidad' => 'Morelos',
                'municipio' => 'Cuernavaca',
                'direccion' => 'Ninguna',
                'estatus' => 'Activo',
                'agencia_id' => '1',
                'zona_id' => '1',
            ],
            [
                'id'             => 2,
                'nombre'           => 'Cometra Centro',
                'entidad' => 'Morelos',
                'municipio' => 'Temixco',
                'direccion' => 'Ninguna',
                'estatus' => 'Activo',
                'agencia_id' => '1',
                'zona_id' => '1',
            ],
            [
                'id'             => 3,
                'nombre'           => 'Sepsa Norte',
                'entidad' => 'Estado de México',
                'municipio' => 'Toluca',
                'direccion' => 'Ninguna',
                'estatus' => 'Activo',
                'agencia_id' => '2',
                'zona_id' => '2',
            ],
            [
                'id'             => 4,
                'nombre'           => 'Sepsa Centro',
                'entidad' => 'Estado de México',
                'municipio' => 'Toluca',
                'direccion' => 'Ninguna',
                'estatus' => 'Activo',
                'agencia_id' => '2',
                'zona_id' => '2',
            ],

        ];

        Sucursal::insert($sucursals);
    }
}
