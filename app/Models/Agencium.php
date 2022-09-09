<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agencium extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ESTATUS_RADIO = [
        'Activo'   => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    public $table = 'agencia';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'empresa_id',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function agenciaSucursals()
    {
        return $this->hasMany(Sucursal::class, 'agencia_id', 'id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
