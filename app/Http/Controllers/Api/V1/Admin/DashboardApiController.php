<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAsignacioneRequest;
use App\Http\Requests\UpdateAsignacioneRequest;
use App\Http\Resources\Admin\AsignacioneResource;

use App\Models\mensajero;
use App\Models\Almacen;
use App\Models\Sucursal;
use App\Models\Prendas;
use App\Models\Inventarioprincipal;
use App\Models\Asignacione;
use App\Models\CatTalla;
use App\Models\CatTiposprenda;
use App\Models\Empleado;
use App\Models\Prenda;
use Gate;
use Illuminate\Http\Request;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class DashboardApiController extends Controller
{

    public function tallasAsignadasGraph($orden)
    {
        $json = new stdClass();
        $valores = [];
        $i = 0;

        $classAsignaciones = new Asignacione();
        $datos = $classAsignaciones->getTotalAsignacionesPorTallas($orden);

        foreach ($datos as $reg) {
            $valores[$i]["name"] = $reg->categoria;
            $valores[$i]["y"] = (int)$reg->valores;
            $i++;
        }
        $json->result = "ok";
        $json->message = "Respuesta del método GET tallasAsignadasGraph";
        $serie = new stdClass();
        $serie->name = "Prendas";
        $serie->data = $valores;
        $json->valores = $serie;

        $json->description = "Asignaciones por tipo de prenda";
        //mensajero::arregloPantalla($json);
        return $json;
    }
    public function inventarios()
    {
        $inventario = new stdClass;
        $inventarioprincipal = new Inventarioprincipal();
        $inventario->inventarioprincipal = $inventarioprincipal->getInventarios();
        $almacenes = new Almacen();
        $inventario->almacenes = $almacenes->getAlmacenes();
        return $inventario;
    }
    public function empleados()
    {
        $classEmpleado = new Empleado();
        return $classEmpleado->getTotalEmpleadosPorSucursal();
    }
    public function prendas()
    {
        $classPrendas = new Prenda();
        return $classPrendas->getTotalPrendasPorEstatus();
    }
}
