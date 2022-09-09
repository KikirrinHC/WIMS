<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zona extends Model
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

    public $table = 'zonas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'descripcion',
        'entidad',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function zonaSucursals()
    {
        return $this->hasMany(Sucursal::class, 'zona_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
