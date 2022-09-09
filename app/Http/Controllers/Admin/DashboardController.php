<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAlmacenRequest;
use App\Http\Requests\StoreAlmacenRequest;
use App\Http\Requests\UpdateAlmacenRequest;
use App\Models\Almacen;
use App\Models\Sucursal;
use App\Models\Prendas;
use App\Models\Inventarioprincipal;
use App\Models\Empleado;
use Gate;
use Illuminate\Http\Request;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('almacen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $almacenes = new Almacen();
        $almacen = $almacenes->getAlmacenes();
        return view('admin.almacenes.index', compact('almacen'));
    }

    public function create()
    {
        abort_if(Gate::denies('almacen_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.almacenes.create');
    }

    public function store(StoreAlmacenRequest $request)
    {
        $almacen = Almacen::create($request->all());

        return redirect()->route('admin.almacenes.index');
    }

    public function edit($id, $tipo)
    {
        abort_if(Gate::denies('almacen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $almacenClass = new Almacen();
        $almacen = $almacenClass->getAlmacen($id);
        return view('admin.almacenes.edit', compact('almacen', 'tipo'));
    }

    public function update(UpdateAlmacenRequest $request, $id, $tipo)
    {

        $almacenClass = new Almacen();
        $almacen = $almacenClass->getAlmacen($id);
        $cantidad = $almacen->cantidad;
        if ($tipo == "add") {
            $cantidad += $request->input('cantidad');
        } else if ($tipo == "substract") {
            if ($request->input('cantidad') <= $cantidad) {
                $cantidad -= $request->input('cantidad');
            }
        }

        $almacenAudit = AlmacenAudit::create([
            'cantidad' => $request->input('cantidad'),
            'accion' => $tipo,
            'descripcion' => $request->input('descripcion'),
            'almacen_id' => $id,
            'user_id' => auth()->user()->id,

        ]);
        $response = $almacenClass->updateCantidad($id, $cantidad);

        /*echo 'REQUESTS <script>';
            echo 'console.log(' . json_encode($inventarioprincipalAudit) . ')';
            echo '</script>';*/

        return redirect()->route('admin.almacenes.index');
    }

    public function updateTransferFromInventario(stdClass $request)
    {

        $almacenClass = new Almacen();
        $almacen = $almacenClass->getAlmacenPorAtributos($request->recibe, $request->cat_tallas_id, $request->cat_tiposprendas_id);

        /* echo ("Almacen <pre>");
        print_r($almacen);
        echo ("</pre>");
        */
        $almacen = $almacen[0];

        $cantidad = $almacen->cantidad;
        $cantidad += $request->cantidad;

        $almacenAudit = AlmacenAudit::create([
            'cantidad' =>  $request->cantidad,
            'accion' => "transfer from Inventario",
            'descripcion' => "transferencia del inventario principal al almacen " . $almacen->id,
            'almacen_id' => $almacen->id,
            'user_id' => auth()->user()->id,

        ]);
        $response = $almacenClass->updateCantidad($almacen->id, $cantidad);

        /*echo 'REQUESTS <script>';
            echo 'console.log(' . json_encode($inventarioprincipalAudit) . ')';
            echo '</script>';*/

        return redirect()->route('admin.almacenes.index');
    }

    public function devolucion($id)
    {
        abort_if(Gate::denies('almacen_transfer'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classAlmacen = new Almacen();
        $almacen = $classAlmacen->getAlmacen($id);

        return view('admin.almacenes.devolucion', compact('almacen'));
    }
    public function updateDevolucionToInventario(UpdateAlmacenRequest $request, $id)
    {


        $almacenClass = new Almacen();
        $almacen = $almacenClass->getAlmacen($id);


        $cantidad = $almacen->cantidad;
        if ($request->input('cantidad') <= $cantidad) {
            $cantidad -= $request->input('cantidad');

            $almacenAudit = AlmacenAudit::create([
                'cantidad' =>  $request->cantidad,
                'accion' => "devolución to Inventario",
                'descripcion' => "devolución al inventario principal desde el almacen " . $almacen->id,
                'almacen_id' => $almacen->id,
                'user_id' => auth()->user()->id,

            ]);

            $update = new stdClass();
            $update->envia = $id;
            $update->cat_tallas_id = $request->input('cat_tallas_id');
            $update->cat_tiposprendas_id = $request->input('cat_tiposprendas_id');
            $update->cantidad = $request->input('cantidad');

            $controlInventario = new InventarioprincipalController();
            $responseInventario = $controlInventario->updateDevolucionFromAlmacen($update);


            $response = $almacenClass->updateCantidad($almacen->id, $cantidad);
        }

        return redirect()->route('admin.almacenes.index');
    }

    public function transfer($id)
    {
        abort_if(Gate::denies('inventarioprincipal_transfer'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classAlmacen = new Almacen();
        $almacen = $classAlmacen->getAlmacen($id);
        $almacenes = $classAlmacen->getSucursalesEnAlmacen();
        /*
        echo ("<pre>");
        print_r($almacen);
        echo ("</pre>");
*/

        return view('admin.almacenes.transfer', compact('almacen', 'almacenes'));
    }


    public function updateTransferBetweenAlmacenes(UpdateAlmacenRequest $request, $id)
    {

        $almacenClass = new Almacen();
        $almacenRecibe = $almacenClass->getAlmacenPorAtributos($request->input('recibe'), $request->input('cat_tallas_id'), $request->input('cat_tiposprendas_id'));
        $almacenRecibe = $almacenRecibe[0];
        $almacenEnvia = $almacenClass->getAlmacen($id);
        $cantidadRecibe = $cantidadEnvia = 0;

        if ($request->input('cantidad') <= $almacenEnvia->cantidad) {
            $cantidadEnvia = $almacenEnvia->cantidad - $request->input('cantidad');

            $almacenAudit = AlmacenAudit::create([
                'cantidad' =>  $request->input('cantidad'),
                'accion' => "transfer to Almacen",
                'descripcion' => "transferencia del almacen " . $almacenEnvia->id . " al almacen " . $almacenRecibe->id,
                'almacen_id' => $almacenEnvia->id,
                'user_id' => auth()->user()->id,

            ]);
            $response = $almacenClass->updateCantidad($almacenEnvia->id, $cantidadEnvia);

            $cantidadRecibe = $almacenRecibe->cantidad + $request->input('cantidad');

            $almacenAudit = AlmacenAudit::create([
                'cantidad' =>  $request->input('cantidad'),
                'accion' => "transfer from Almacen",
                'descripcion' => "transferencia del almacen " . $almacenEnvia->id . " al almacen " . $almacenRecibe->id,
                'almacen_id' => $almacenRecibe->id,
                'user_id' => auth()->user()->id,

            ]);
            $response = $almacenClass->updateCantidad($almacenRecibe->id, $cantidadRecibe);
        }


        return redirect()->route('admin.almacenes.index');
    }

    public function populateAlmacenes($valor)
    {

        $classSucursal = new Sucursal();
        $sucursales = $classSucursal->getSucursales();
        foreach ($sucursales as $sucursal) {
            $classSucursal->populateTallasEnAlmacen($sucursal);
        }
        $classAlmacen = new Almacen();
        $almacen = $classAlmacen->getAlmacenes();
        return view('admin.almacenes.index', compact('almacen'));
    }
    public function show($id)
    {
        $almacen = new stdClass;
        abort_if(Gate::denies('almacen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classAlmacen = new Almacen();

        $almacen->detalles = $classAlmacen->cat_tallas_prendas($id);
        $almacen->resumen = $classAlmacen->getExistenciasAlmacen($id);
        return view('admin.almacenes.show', compact('almacen'));
    }

    public function destroy(Almacen $almacen)
    {
        abort_if(Gate::denies('almacen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $almacen->delete();

        return back();
    }

    /* public function massDestroy(MassDestroyAlmacenRequest $request)
    {
        Almacen::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    */
}
