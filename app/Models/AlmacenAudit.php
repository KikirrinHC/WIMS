<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlmacenAudit extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;


    public $table = 'almacen_audit';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'almacen_id',
        'cantidad',
        'accion',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    /*
    public function getInventario($id)
    {
        return DB::table('inventarioprincipal')->find($id);
    }

    public function updateCantidad($id, $cantidad)
    {
        return DB::table('inventarioprincipal')
            ->where('id', $id)
            ->update(['cantidad' => $cantidad]);
    }

    public function cat_tallas_prendas()
    {


        $datos = DB::table('inventarioprincipal')
            ->join('cat_tallas', 'inventarioprincipal.cat_tallas_id', '=', 'cat_tallas.id')
            ->join('cat_tiposprendas', 'cat_tallas.tipoprenda_id', '=', 'cat_tiposprendas.id')
            ->select('inventarioprincipal.id', 'inventarioprincipal.cantidad', 'cat_tallas.talla', 'cat_tiposprendas.tipo')
            ->orderBy('inventarioprincipal.id', 'asc')
            ->get();

        return $datos;
    }
    
    public function tipoprenda()
    {
        return $this->belongsTo(CatTiposprenda::class, 'tipoprenda_id');
    }

    public function cat_tallas()
    {
        return $this->belongsTo(CatTalla::class, 'cat_tallas_id');
    }
    */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
