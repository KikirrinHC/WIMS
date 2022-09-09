<?php

namespace App\Models;

use App\Models\mensajero;
use Illuminate\Support\Facades\DB;

use App\Models\AsignacionesAudit;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asignacione extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'asignaciones';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'empleado_id',
        'sucursals_id',
        'qr',
        'descripcion',
        'cat_tallas_id',
        'cat_tiposprendas_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function change($values, $id)
    {
        /*  echo ("<br>Values-------<pre>");
        print_r($values);
        echo ("</pre>");*/
        return DB::table('asignaciones')
            ->where('id', $id)
            ->update(['qr' => $values['qr'], 'descripcion' => $values['descripcion'], 'sucursals_id' => $values['sucursals_id'], 'empleado_id' => $values['empleado_id'], 'cat_tiposprendas_id' => $values['cat_tiposprendas_id'], 'cat_tallas_id' => $values['cat_tallas_id']]);
    }
    public function getAsignacion($id)
    {
        return DB::table('asignaciones')->find($id);
    }

    public function crearAsignacion($empleado, $request)
    {
        mensajero::mensajeConsola("vino al método de crear asignación");

        $asignacion = $this::create($request->all());
        $asignacionesAudit = AsignacionesAudit::create([
            'qr' => $request->input('qr'),
            'accion' => "Asignación",
            'descripcion' => "asignación de prenda " . $request->input('cat_tiposprendas_id') . " talla " . $request->input('cat_tallas_id') . " al empleado " . $empleado->id,
            'empleados_id' => $empleado->id,
            'sucursals_id' => $empleado->sucursal_id,
            'cat_tallas_id' => $request->input('cat_tallas_id'),
            'cat_tiposprendas_id' => $request->input('cat_tiposprendas_id'),
            'asignaciones_id' => $asignacion->id,
            'user_id' => auth()->user()->id,

        ]);
        return $asignacion;
    }


    public function updateAsignacion($valores, $asignacion, $accion)
    {
        mensajero::mensajeConsola("vino al método de actualizar asignación");
        mensajero::arregloPantalla($valores);
        $response = DB::table('asignaciones')
            ->where('id', $asignacion->id)
            ->update($valores);

        if ($accion == "Cambio") {
            $mod = "Se cambió la prenda " . $asignacion->qr . " por " . $valores['qr'];
        } else {
            $mod = "Se modificó el QR de la prenda " . $asignacion->qr . " por " . $valores['qr'] . " en la asignación";
        }
        if ($response) {
            $asignacionesAudit = AsignacionesAudit::create([
                'qr' => $asignacion->qr,
                'accion' => $accion,
                'descripcion' => $mod,
                'empleados_id' => $asignacion->empleado_id,
                'sucursals_id' => $asignacion->sucursals_id,
                'cat_tallas_id' => $asignacion->cat_tallas_id,
                'cat_tiposprendas_id' => $asignacion->cat_tiposprendas_id,
                'asignaciones_id' => $asignacion->id,
                'user_id' => auth()->user()->id,

            ]);
            return $response;
        } else {
            return 0;
        }
    }

    public function getTotalAsignacionesPorTallas($orden)
    {
        return DB::table('asignaciones')
            ->join('cat_tallas', 'asignaciones.cat_tallas_id', '=', 'cat_tallas.id')
            ->join('cat_tiposprendas', 'cat_tallas.tipoprenda_id', '=', 'cat_tiposprendas.id')
            ->select(DB::raw('COUNT(asignaciones.id) as valores'), DB::raw('CONCAT(cat_tiposprendas.tipo, " talla ", cat_tallas.talla) as categoria'))
            ->groupBy('asignaciones.cat_tallas_id')
            ->orderBy('valores', $orden)
            ->limit(10)
            ->get();
    }













    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
