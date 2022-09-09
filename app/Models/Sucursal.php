<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CatTallas;


class Sucursal extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ESTATUS_RADIO = [
        'Activo'   => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    public const ENTIDAD_SELECT = [
        'Aguascalientes'      => 'Aguascalientes',
        'Baja California'     => 'Baja California',
        'Baja California Sur' => 'Baja California Sur',
        'Campeche'            => 'Campeche',
        'Coahuila'            => 'Coahuila',
        'Colima'              => 'Colima',
        'Chiapas'             => 'Chiapas',
        'Chihuahua'           => 'Chihuahua',
        'Ciudad de México'    => 'Ciudad de México',
        'Durango'             => 'Durango',
        'Guanajuato'          => 'Guanajuato',
        'Guerrero'            => 'Guerrero',
        'Hidalgo'             => 'Hidalgo',
        'Jalisco'             => 'Jalisco',
        'Estado de México'    => 'Estado de México',
        'Michoacán'           => 'Michoacán',
        'Morelos'             => 'Morelos',
        'Nayarit'             => 'Nayarit',
        'Nuevo León'          => 'Nuevo León',
        'Oaxaca'              => 'Oaxaca',
        'Puebla'              => 'Puebla',
        'Querétaro'           => 'Querétaro',
        'Quintana Roo'        => 'Quintana Roo',
        'San Luis Potosí'     => 'San Luis Potosí',
        'Sinaloa'             => 'Sinaloa',
        'Sonora'              => 'Sonora',
        'Tabasco'             => 'Tabasco',
        'Tamaulipas'          => 'Tamaulipas',
        'Tlaxcala'            => 'Tlaxcala',
        'Veracruz'            => 'Veracruz',
        'Yucatán'             => 'Yucatán',
        'Zacatecas'           => 'Zacatecas',
    ];

    public $table = 'sucursals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'agencia_id',
        'zona_id',
        'entidad',
        'municipio',
        'direccion',
        'latitud',
        'longitud',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getSucursales()
    {
        return DB::table('sucursals')->pluck('id');
    }

    public function getSucursalesConEmpleados()
    {
        return DB::table('sucursals')
            ->join('empleados', 'empleados.sucursal_id', '=', 'sucursals.id')
            ->select('sucursals.id', 'sucursals.nombre')
            ->groupBy('sucursals.id')
            ->get();
    }

    public function existenSucursales()
    {
        return DB::table('sucursals')->count();
    }

    public function populateTallasEnAlmacen($sucursal)
    {
        $claseTallas = new CatTalla();
        $existen = $claseTallas->existenTallas();
        if ($existen > 0) {
            $tallas = $claseTallas->getTallas();

            // print_r($tallas);
            foreach ($tallas as $talla) {
                //print_r($talla);
                Almacen::create([
                    'cantidad' => 0,
                    'cat_tallas_id' => $talla->id,
                    'cat_tiposprendas_id' => $talla->tipoprenda_id,
                    'sucursals_id' => $sucursal
                ]);
            }
        }
    }

    public function agencia()
    {
        return $this->belongsTo(Agencium::class, 'agencia_id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zona_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
