<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInventarioprincipalRequest;
use App\Http\Requests\StoreInventarioprincipalRequest;
use App\Http\Requests\UpdateInventarioprincipalRequest;
use App\Models\CatTalla;
use App\Models\CatTiposprenda;
use App\Models\Almacen;
use App\Models\Inventarioprincipal;
use App\Models\InventarioprincipalAudit;

use Gate;
use Illuminate\Http\Request;
use stdClass;
use Symfony\Component\HttpFoundation\Response;

class InventarioprincipalController extends Controller
{
    public function index()
    {
        $inventarioppal = new stdClass;
        abort_if(Gate::denies('inventarioprincipal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inventarioprincipal = new Inventarioprincipal();
        $inventarioppal->detalles = $inventarioprincipal->cat_tallas_prendas();
        $inventarioppal->resumen = $inventarioprincipal->getInventarios();
        return view('admin.inventarioprincipals.index', compact('inventarioppal'));
    }

    public function create()
    {
        abort_if(Gate::denies('inventarioprincipal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.inventarioprincipals.create');
    }

    public function store(StoreInventarioprincipalRequest $request)
    {
        $inventarioprincipal = Inventarioprincipal::create($request->all());

        return redirect()->route('admin.inventarioprincipals.index');
    }

    public function edit($id, $tipo)
    {
        abort_if(Gate::denies('inventarioprincipal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inventarioprincipal = new Inventarioprincipal();
        $inventario = $inventarioprincipal->getInventario($id);
        return view('admin.inventarioprincipals.edit', compact('inventario', 'tipo'));
    }

    public function update(UpdateInventarioprincipalRequest $request, $id, $tipo)
    {

        $inventarioprincipal = new Inventarioprincipal();
        $inventario = $inventarioprincipal->getInventario($id);
        $cantidad = $inventario->cantidad;
        if ($tipo == "add") {
            $cantidad += $request->input('cantidad');
        } else if ($tipo == "substract") {
            if ($request->input('cantidad') <= $cantidad) {
                $cantidad -= $request->input('cantidad');
            }
        }
        if ($request->input('descripcion') == "") {
            $descripcion = "Sin comentario";
        } else {
            $descripcion = $request->input('descripcion');
        }
        $inventarioprincipalAudit = inventarioprincipalAudit::create([
            'cantidad' => $request->input('cantidad'),
            'accion' => $tipo,
            'descripcion' => $descripcion,
            'inventario_id' => $id,
            'user_id' => auth()->user()->id,

        ]);
        $response = $inventarioprincipal->updateCantidad($id, $cantidad);

        /*echo 'REQUESTS <script>';
        echo 'console.log(' . json_encode($inventarioprincipalAudit) . ')';
        echo '</script>';*/

        return redirect()->route('admin.inventarioprincipals.index');
    }

    public function transfer($id)
    {
        abort_if(Gate::denies('inventarioprincipal_transfer'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inventarioprincipal = new Inventarioprincipal();
        $inventario = $inventarioprincipal->getInventario($id);
        $classAlmacen = new Almacen();
        $almacenes = $classAlmacen->getSucursalesEnAlmacen();

        /*echo ("<pre>");
        print_r($almacenes);
        echo ("</pre>");
*/

        return view('admin.inventarioprincipals.transfer', compact('inventario', 'almacenes'));
    }

    public function updateTransferToAlmacen(UpdateInventarioprincipalRequest $request, $id)
    {

        $inventarioprincipal = new Inventarioprincipal();
        $inventario = $inventarioprincipal->getInventario($id);
        $cantidad = $inventario->cantidad;
        if ($request->input('cantidad') <= $cantidad) {
            $cantidad -= $request->input('cantidad');

            $inventarioprincipalAudit = inventarioprincipalAudit::create([
                'cantidad' => $request->input('cantidad'),
                'accion' => "Transferencia al Almacén",
                'descripcion' => "Transferencia al almacén de sucursal " . $request->input('recibe') . " por: " . $request->input('descripcion'),
                'inventario_id' => $id,
                'user_id' => auth()->user()->id,

            ]);

            $update = new stdClass();
            $update->recibe = $request->input('recibe');
            $update->cat_tallas_id = $request->input('cat_tallas_id');
            $update->cat_tiposprendas_id = $request->input('cat_tiposprendas_id');
            $update->cantidad = $request->input('cantidad');

            $controlAlmacen = new AlmacenesController();
            $responseAlmacen = $controlAlmacen->updateTransferFromInventario($update);

            $response = $inventarioprincipal->updateCantidad($id, $cantidad);
        }


        return redirect()->route('admin.inventarioprincipals.index');
    }

    public function updateDevolucionFromAlmacen(stdClass $request)
    {

        $classInventario = new Inventarioprincipal();
        $inventario = $classInventario->getInventarioPorAtributos($request->cat_tallas_id, $request->cat_tiposprendas_id);

        $inventario = $inventario[0];

        $cantidad = $inventario->cantidad;
        $cantidad += $request->cantidad;

        $inventarioAudit = InventarioprincipalAudit::create([
            'cantidad' =>  $request->cantidad,
            'accion' => "devolución from Almacen",
            'descripcion' => "devolucion del almacen " . $request->envia,
            'inventario_id' => $inventario->id,
            'user_id' => auth()->user()->id,

        ]);
        $response = $classInventario->updateCantidad($inventario->id, $cantidad);

        return redirect()->route('admin.almacenes.index');
    }


    public function show(Inventarioprincipal $inventarioprincipal)
    {
        abort_if(Gate::denies('inventarioprincipal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.inventarioprincipals.show', compact('inventarioprincipal'));
    }

    public function destroy(Inventarioprincipal $inventarioprincipal)
    {
        abort_if(Gate::denies('inventarioprincipal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $inventarioprincipal->delete();

        return back();
    }

    public function massDestroy(MassDestroyInventarioprincipalRequest $request)
    {
        Inventarioprincipal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
