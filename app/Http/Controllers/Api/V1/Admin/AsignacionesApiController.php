<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAsignacioneRequest;
use App\Http\Requests\UpdateAsignacioneRequest;
use App\Http\Resources\Admin\AsignacioneResource;
use App\Models\Almacen;
use App\Models\Sucursal;
use App\Models\Prendas;
use App\Models\Inventarioprincipal;
use App\Models\Asignacione;
use App\Models\CatTalla;
use App\Models\CatTiposprenda;
use App\Models\Empleado;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AsignacionesApiController extends Controller
{
    public function getEmpleado($id)
    {
        //abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classEmpleado = new Empleado();
        return $classEmpleado->getEmpleado($id);
    }

    public function getEmpleadosPorSucursal($id)
    {
        //abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classEmpleado = new Empleado();
        return $classEmpleado->getEmpleadosOrdenadosPorSucursal($id);
    }

    public function getTiposPrendasPorSucursal($id)
    {
        //abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classTipoPrendas = new CatTiposprenda();
        return $classTipoPrendas->getTiposPrendasPorSucursal($id);
    }

    public function getTallasPorTipoPrenda($idSucursal, $idPrenda)
    {
        //abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classTallas = new CatTalla();
        return $classTallas->getTallasPorTipoPrendaPorSucursal($idSucursal, $idPrenda);
    }

    public function disponibilidadPrenda($id, $talla)
    {
        //abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classAsignaciones = new Asignacione();
        $asignacion = $classAsignaciones->getAsignacion($id);

        //DOCUMENTACIÓN   Aquí se verifica si existen prendas disponibles en el almacén
        $almacenClass = new Almacen();

        if ($talla != 0) {
            $almacen = $almacenClass->getExistenciasTallasAlmacenPorPrendaExcluyeTalla($asignacion->sucursals_id, $asignacion->cat_tiposprendas_id, $talla);
            if ($almacen->count() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            $almacen = $almacenClass->getAlmacenPorAtributos($asignacion->sucursals_id, $asignacion->cat_tallas_id, $asignacion->cat_tiposprendas_id);

            $almacen = $almacen[0];
            if ($almacen->cantidad > 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function disponibilidadTallas($id, $talla)
    {
        //abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classAsignaciones = new Asignacione();
        $asignacion = $classAsignaciones->getAsignacion($id);

        //DOCUMENTACIÓN   Aquí se obtienen las tallas disponibles en el almacén
        $almacenClass = new Almacen();
        return $almacenClass->getExistenciasTallasAlmacenPorPrendaExcluyeTalla($asignacion->sucursals_id, $asignacion->cat_tiposprendas_id, $talla);
    }










    /*
    public function index()
    {
        abort_if(Gate::denies('asignacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AsignacioneResource(Asignacione::with(['empleado'])->get());
    }

    public function store(StoreAsignacioneRequest $request)
    {
        $asignacione = Asignacione::create($request->all());

        return (new AsignacioneResource($asignacione))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Asignacione $asignacione)
    {
        abort_if(Gate::denies('asignacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AsignacioneResource($asignacione->load(['empleado']));
    }

    public function update(UpdateAsignacioneRequest $request, Asignacione $asignacione)
    {
        $asignacione->update($request->all());

        return (new AsignacioneResource($asignacione))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Asignacione $asignacione)
    {
        abort_if(Gate::denies('asignacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asignacione->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    */
}

