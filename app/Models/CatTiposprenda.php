<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class CatTiposprenda extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ESTATUS_RADIO = [
        'Activo'   => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    public $table = 'cat_tiposprendas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'tipo',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tipoprendaCatTallas()
    {
        return $this->hasMany(CatTalla::class, 'tipoprenda_id', 'id');
    }

    public function getTiposPrendasTallas()
    {
        /*return DB::table('cat_tallas')
            ->join('cat_tiposprendas', 'cat_tiposprendas.id', '=', 'cat_tallas.tipoprenda_id')
            ->select('cat_tiposprendas.id', 'cat_tiposprendas.tipo', 'cat_tallas.id', 'cat_tallas.talla',)
            ->orderBy('cat_tiposprendas.tipo')
            ->get();
*/

        $prendas = DB::table('cat_tiposprendas')
            ->select('id', 'tipo')
            ->orderBy('tipo')
            ->get();
        foreach ($prendas as $prenda) {
            $prenda->tallas = DB::table('cat_tallas')
                ->select('id', 'talla')
                ->where('cat_tallas.tipoprenda_id', '=', $prenda->id)
                ->orderBy('talla')
                ->get();
        }
        return $prendas;
    }

    public function getTiposPrendasPorSucursal($id)
    {
        return DB::table('cat_tiposprendas')
            ->join('almacen', 'almacen.cat_tiposprendas_id', '=', 'cat_tiposprendas.id')
            ->select(DB::raw('SUM(almacen.cantidad) as total'), 'cat_tiposprendas.tipo', 'cat_tiposprendas.id')
            ->groupBy('cat_tiposprendas.id')
            ->where('almacen.sucursals_id', '=', $id)
            ->having('total', '>', 0)
            ->get();
    }

    public function getExistencias()
    {
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
