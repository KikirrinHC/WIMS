<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatTalla extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ESTATUS_RADIO = [
        'Activo'   => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    public $table = 'cat_tallas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipoprenda_id',
        'talla',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTallas()
    {
        return DB::table('cat_tallas')->select('id', 'tipoprenda_id')->get();

        //DB::table('cat_tallas')->pluck('id');
    }

    public function getTallasPorPrenda($id)
    {
        return DB::table('cat_tallas')->select('id', 'talla')->where('tipoprenda_id', '=', $id)->get();

        //DB::table('cat_tallas')->pluck('id');
    }

    public function getTallasPorTipoPrendaPorSucursal($idSucursal, $idPrenda)
    {
        return DB::table('cat_tallas')
            ->join('almacen', 'almacen.cat_tallas_id', '=', 'cat_tallas.id')
            ->select(DB::raw('SUM(almacen.cantidad) as total'), 'cat_tallas.talla', 'cat_tallas.id')
            ->groupBy('cat_tallas.id')
            ->where('almacen.sucursals_id', '=', $idSucursal)
            ->where('almacen.cat_tiposprendas_id', '=', $idPrenda)
            ->having('total', '>', 0)
            ->get();
    }

    public function existenTallas()
    {
        return DB::table('cat_tallas')->count();
    }

    public function tipoprenda()
    {
        return $this->belongsTo(CatTiposprenda::class, 'tipoprenda_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
