<?php

namespace App\Models;

use App\Models\mensajero;
use Illuminate\Support\Facades\DB;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prenda extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'prendas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'qr',
        'comentario',
        'dias_uso',
        'estatus',
        'asignaciones_id',
        'cat_tiposprendas_id',
        'cat_tallas_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getPrendas()
    {
        return DB::table('prendas')
            ->join('asignaciones', 'prendas.asignaciones_id', '=', 'asignaciones.id')
            ->join('empleados', 'asignaciones.empleado_id', '=', 'empleados.id')
            ->select('prendas.qr', 'prendas.id', 'prendas.dias_uso', 'prendas.estatus', 'empleados.nombre')
            ->get();
    }
    public function getPrenda($id)
    {
        return DB::table('prendas')->find($id);
    }
    public function getPrendaPorQR($qr)
    {
        return DB::table('prendas')
            ->select('id', 'dias_uso', 'estatus', 'qr')
            ->where('qr', '=', $qr)
            ->get();
    }
    public function getPrendaPorQRyAsignacion($qr, $id)
    {
        return DB::table('prendas')
            ->select('id', 'dias_uso', 'estatus', 'qr')
            ->where('qr', '=', $qr)
            ->where('asignaciones_id', '=', $id)
            ->get();
    }
    public function getPrendaPorQRyEstatus($qr, $estatus)
    {
        return DB::table('prendas')
            ->select('id', 'dias_uso', 'estatus', 'qr')
            ->where('qr', '=', $qr)
            ->where('estatus', '=', $estatus)
            ->get();
    }

    public function getTotalPrendasPorEstatus()
    {
        return DB::table('prendas')
            ->select(DB::raw('count(id) as total'), 'estatus')
            ->groupBy('estatus')
            ->orderBy('estatus')
            ->get();
    }

    public function updateQRPrenda($qr, $qrAnterior, $id)
    {
        return DB::table('prendas')
            ->where('asignaciones_id', $id)
            ->where('qr', '=', $qrAnterior)
            ->update(['qr' => $qr]);
    }
    public function updatePrenda($valores, $prenda, $accion)
    {
        mensajero::arregloPantalla($valores);
        $response = DB::table('prendas')
            ->where('id', $prenda->id)
            ->update($valores);

        if ($response) {
            $prendasAudit = PrendaAudit::create([
                'qr' => $valores['qr'],
                'accion' => $accion,
                'descripcion' => $valores['comentario'],
                'dias_uso' => $prenda->dias_uso,
                'prendas_id' => $prenda->id,
                'user_id' => auth()->user()->id,
            ]);
            return $response;
        } else {
            return 0;
        }
    }

    public function createPrenda($request, $asignacion, $accion)
    {
        mensajero::mensajeConsola("vino al método de crear prenda");
        mensajero::arregloPantalla($request);
        $prenda = Prenda::create([
            'qr' => $request['qr'],
            'cat_tiposprendas_id' => $request['cat_tiposprendas_id'],
            'cat_tallas_id' => $request['cat_tallas_id'],
            'estatus' => "Asignada",
            'comentario' => "Se asigna la prenda al empleado " . $asignacion->empleado_id,
            'dias_uso' => 0,
            'asignaciones_id' => $asignacion->id,
            'user_id' => auth()->user()->id,
        ]);
        if ($prenda->count() > 0) {
            $prendasAudit = PrendaAudit::create([
                'qr' => $request['qr'],
                'accion' => $accion,
                'descripcion' => "Se asignó la prenda QR " . $request['qr'] . " al empleado " . $asignacion->empleado_id,
                'dias_uso' => 0,
                'prendas_id' => $prenda->id,
                'user_id' => auth()->user()->id,

            ]);
            return $prenda;
        } else {
            return 0;
        }
    }

    public function updateStatusPrenda2($valores, $qrAnterior, $id)
    {
        return DB::table('prendas')
            ->where('asignaciones_id', $id)
            ->where('qr', '=', $qrAnterior)
            ->update(['estatus' => $valores['estatus'], 'comentario' =>  $valores['comentario']]);
    }
    public function asignacion()
    {
        return $this->belongsTo(Asignacione::class, 'asignaciones_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
