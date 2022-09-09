<?php

namespace Database\Seeders;

use App\Models\CatTalla;
use Illuminate\Database\Seeder;

class CatTallaTableSeeder extends Seeder
{
    public function run()
    {
        $CatTalla = [

            [
                'id'    => 1,
                'talla' => '30',
                'tipoprenda_id' => '1',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 2,
                'talla' => '32',
                'tipoprenda_id' => '1',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 3,
                'talla' => '34',
                'tipoprenda_id' => '1',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 4,
                'talla' => '36',
                'tipoprenda_id' => '1',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 5,
                'talla' => '38',
                'tipoprenda_id' => '1',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 6,
                'talla' => '40',
                'tipoprenda_id' => '1',
                'estatus' => 'Activo',
            ],

            [
                'id'    => 7,
                'talla' => '30',
                'tipoprenda_id' => '2',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 8,
                'talla' => '32',
                'tipoprenda_id' => '2',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 9,
                'talla' => '34',
                'tipoprenda_id' => '2',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 10,
                'talla' => '36',
                'tipoprenda_id' => '2',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 11,
                'talla' => '38',
                'tipoprenda_id' => '2',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 12,
                'talla' => '40',
                'tipoprenda_id' => '2',
                'estatus' => 'Activo',
            ],

            [
                'id'    => 13,
                'talla' => '30',
                'tipoprenda_id' => '3',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 14,
                'talla' => '32',
                'tipoprenda_id' => '3',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 15,
                'talla' => '34',
                'tipoprenda_id' => '3',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 16,
                'talla' => '36',
                'tipoprenda_id' => '3',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 17,
                'talla' => '38',
                'tipoprenda_id' => '3',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 18,
                'talla' => '40',
                'tipoprenda_id' => '3',
                'estatus' => 'Activo',
            ],

            [
                'id'    => 19,
                'talla' => '30',
                'tipoprenda_id' => '4',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 20,
                'talla' => '32',
                'tipoprenda_id' => '4',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 21,
                'talla' => '34',
                'tipoprenda_id' => '4',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 22,
                'talla' => '36',
                'tipoprenda_id' => '4',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 23,
                'talla' => '38',
                'tipoprenda_id' => '4',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 24,
                'talla' => '40',
                'tipoprenda_id' => '4',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 25,
                'talla' => 'unitalla',
                'tipoprenda_id' => '5',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 26,
                'talla' => '23',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 27,
                'talla' => '24',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 28,
                'talla' => '25',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 29,
                'talla' => '26',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 30,
                'talla' => '27',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 31,
                'talla' => '28',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 32,
                'talla' => '29',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
            [
                'id'    => 33,
                'talla' => '30',
                'tipoprenda_id' => '6',
                'estatus' => 'Activo',
            ],
        ];

        CatTalla::insert($CatTalla);
    }
}
