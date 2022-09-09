<?php

namespace Database\Seeders;

use App\Models\CatTiposprenda;
use Illuminate\Database\Seeder;

class CatTiposprendaTableSeeder extends Seeder
{
    public function run()
    {
        $CatTiposprenda = [
            [
                'id'    => 1,
                'tipo' => 'Camisa',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 2,
                'tipo' => 'Pantalón',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 3,
                'tipo' => 'Chaleco',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 4,
                'tipo' => 'Chamarra',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 5,
                'tipo' => 'Gorra',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 6,
                'tipo' => 'Botas',
                'estatus' => 'Activo',
            ],

        ];

        CatTiposprenda::insert($CatTiposprenda);
    }
}
