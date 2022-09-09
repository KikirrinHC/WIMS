<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
    public function run()
    {
        $empresas = [
            [
                'id'             => 1,
                'nombre'           => 'GSI Seguridad',
                'razonsocial'          => 'G.S.I Seguridad Privada S.A. de C.V.',
                'rfc'       => 'GSP-030225-8C9',
                'estatus' => 'Activo',
            ],
        ];

        Empresa::insert($empresas);
    }
}
