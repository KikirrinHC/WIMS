<?php

namespace App\Models;

use App\Models\mensajero;
use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Almacen extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public const ESTATUS_RADIO = [
        'Activo'   => 'Activo',
        'Inactivo' => 'Inactivo',
    ];

    public $table = 'almacen';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'cat_tallas_id',
        'cat_tiposprendas_id',
        'sucursals_id',
        'cantidad',
        'estatus',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getAlmacen($id)
    {
        return DB::table('almacen')->find($id);
    }

    public function getAlmacenPorAtributos($idSucursal, $idTalla, $idPrenda,)
    {
        return DB::table('almacen')
            ->select('id', 'cantidad')
            ->where('almacen.sucursals_id', '=', $idSucursal)
            ->where('almacen.cat_tallas_id', '=', $idTalla)
            ->where('almacen.cat_tiposprendas_id', '=', $idPrenda)
            ->get();
    }
    public function getExistenciasAlmacen($id)
    {

        $inventario = [];
        $resultado = DB::table('almacen')
            ->join('cat_tiposprendas', 'almacen.cat_tiposprendas_id', '=', 'cat_tiposprendas.id')
            ->select(DB::raw('SUM(almacen.cantidad) as total'), 'cat_tiposprendas.tipo')
            ->groupBy('almacen.cat_tiposprendas_id')
            ->where('almacen.sucursals_id', '=', $id)
            ->get();

        foreach ($resultado as $res) {
            $inventario[$res->tipo] = $res->total;
        }
        return $inventario;
    }
    public function getSucursalesEnAlmacen()
    {
        // return DB::table('almacen')->pluck('sucursals_id');
        return DB::table('almacen')
            ->join('sucursals', 'almacen.sucursals_id', '=', 'sucursals.id')
            ->select('almacen.sucursals_id', 'sucursals.nombre')
            ->groupBy('almacen.sucursals_id')
            ->get();
        // return DB::table('almacen')->select('sucursals_id', '')->distinct('sucursals_id')->get();
    }
    public function getAlmacenes()
    {
        $datos = new stdClass;
        $sucursales = $this->getSucursalesEnAlmacen();
        $i = 0;
        foreach ($sucursales as $sucursal) {
            $datos->$i = $sucursal;
            $inventario = [];
            $resultado = DB::table('almacen')
                ->join('cat_tiposprendas', 'almacen.cat_tiposprendas_id', '=', 'cat_tiposprendas.id')
                ->select(DB::raw('SUM(almacen.cantidad) as total'), 'cat_tiposprendas.tipo')
                ->groupBy('almacen.cat_tiposprendas_id')
                ->where('almacen.sucursals_id', '=', $sucursal->sucursals_id)
                ->get();
            foreach ($resultado as $res) {
                $inventario[$res->tipo] = $res->total;
            }
            $datos->$i->inventario = $inventario;
            $i++;
        }
        return $datos;
    }

    public function getAlmacenesBasico()
    {
        $datos = new stdClass;
        $sucursales = $this->getSucursalesEnAlmacen();
        $i = 0;
        foreach ($sucursales as $sucursal) {
            $datos->$i = $sucursal;
            $inventario = [];
            $resultado = DB::table('almacen')
                ->join('cat_tiposprendas', 'almacen.cat_tiposprendas_id', '=', 'cat_tiposprendas.id')
                ->select(DB::raw('SUM(almacen.cantidad) as total'), 'cat_tiposprendas.tipo')
                ->groupBy('almacen.cat_tiposprendas_id')
                ->where('almacen.sucursals_id', '=', $sucursal->sucursals_id)
                ->get();
            foreach ($resultado as $res) {
                $inventario[$res->tipo] = $res->total;
            }
            $datos->$i->inventario = $inventario;
            $i++;
        }
        return $datos;
    }

    public function updateCantidad($id, $cantidad)
    {
        return DB::table('almacen')
            ->where('id', $id)
            ->update(['cantidad' => $cantidad]);
    }

    public function getTallasAlmacenPorPrenda($idSucursal, $idPrenda)
    {


        $datos = DB::table('almacen')
            ->join('cat_tallas', 'almacen.cat_tallas_id', '=', 'cat_tallas.id')
            ->join('cat_tiposprendas', 'cat_tallas.tipoprenda_id', '=', 'cat_tiposprendas.id')
            ->select('almacen.id', 'almacen.cantidad', 'cat_tallas.talla', 'cat_tiposprendas.tipo')
            ->orderBy('almacen.id', 'asc')
            ->where('almacen.sucursals_id', '=', $idSucursal)
            ->where('almacen.cat_tiposprendas_id', '=', $idPrenda)
            ->get();

        return $datos;
    }

    public function getExistenciasTallasAlmacenPorPrendaExcluyeTalla($idSucursal, $idPrenda, $talla)
    {


        $datos = DB::table('almacen')
            ->join('cat_tallas', 'almacen.cat_tallas_id', '=', 'cat_tallas.id')
            ->join('cat_tiposprendas', 'cat_tallas.tipoprenda_id', '=', 'cat_tiposprendas.id')
            ->select('cat_tallas.id', 'almacen.cantidad', 'cat_tallas.talla', 'cat_tiposprendas.tipo')
            ->orderBy('almacen.id', 'asc')
            ->where('almacen.sucursals_id', '=', $idSucursal)
            ->where('almacen.cat_tiposprendas_id', '=', $idPrenda)
            ->where('almacen.cat_tallas_id', '!=', $talla)
            ->where('almacen.cantidad', '>', 0)
            ->get();

        return $datos;
    }


    public function extraerPrenda($almacen, $request, $accion)
    {
        mensajero::mensajeConsola("vino al método de extraer prenda del almacén");
        $response = $this->updateCantidad($almacen->id, $almacen->cantidad - 1);
        $almacenAudit = AlmacenAudit::create([
            'cantidad' => 1,
            'accion' => $accion,
            'descripcion' => "Salida de prenda " . $request->input('cat_tiposprendas_id') . " talla " . $request->input('cat_tallas_id') . " al empleado " . $request->input('empleado_id'),
            'almacen_id' => $almacen->id,
            'user_id' => auth()->user()->id,

        ]);
        return $response;
    }

    public function ingresarPrenda($almacen, $request, $accion)
    {
        mensajero::mensajeConsola("vino al método de ingresar prenda al almacén");
        $response = $this->updateCantidad($almacen->id, $almacen->cantidad + 1);
        $almacenAudit = AlmacenAudit::create([
            'cantidad' => 1,
            'accion' => $accion,
            'descripcion' => "Entrada de prenda " . $request->input('cat_tiposprendas_id') . " talla " . $request->input('cat_tallas_id'),
            'almacen_id' => $almacen->id,
            'user_id' => auth()->user()->id,

        ]);
        return $response;
    }







    public function cat_tallas_prendas($id)
    {
        $datos = DB::table('almacen')
            ->join('cat_tallas', 'almacen.cat_tallas_id', '=', 'cat_tallas.id')
            ->join('cat_tiposprendas', 'cat_tallas.tipoprenda_id', '=', 'cat_tiposprendas.id')
            ->select('almacen.id', 'almacen.cantidad', 'cat_tallas.talla', 'cat_tiposprendas.tipo')
            ->orderBy('almacen.id', 'asc')
            ->where('almacen.sucursals_id', '=', $id)
            ->get();

        return $datos;
    }

    public function cat_tallas()
    {
        return $this->belongsTo(CatTalla::class, 'cat_tallas_id');
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
