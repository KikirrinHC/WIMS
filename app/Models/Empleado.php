<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'empleados';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'clave',
        'nombre',
        'sucursal_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function empleadoAsignaciones()
    {
        return $this->hasMany(Asignacione::class, 'empleado_id', 'id');
    }

    public function getEmpleadosOrdenados()
    {
        return DB::table('empleados')
            ->select('id', 'clave', 'nombre')
            ->orderBy('nombre')
            ->get();
    }


    public function getEmpleadosOrdenadosPorSucursal($id)
    {
        return DB::table('empleados')
            ->select('id', 'clave', 'nombre')
            ->where('sucursal_id', '=', $id)
            ->orderBy('nombre')
            ->get();
    }

    public function getTotalEmpleadosPorSucursal()
    {
        return DB::table('empleados')
            ->join('sucursals', 'empleados.sucursal_id', '=', 'sucursals.id')
            ->select(DB::raw('count(empleados.id) as total'), 'sucursals.nombre')
            ->groupBy('sucursals.id')
            ->orderBy('sucursals.nombre')
            ->get();
    }

    public function getEmpleado($id)
    {
        return DB::table('empleados')->find($id);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
