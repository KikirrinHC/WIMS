<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInventarioprincipalRequest;
use App\Http\Requests\StoreInventarioprincipalRequest;
use App\Http\Requests\UpdateInventarioprincipalRequest;
use App\Models\Inventarioprincipal;
use App\Http\Requests\StoreAsignacionesAuditRequest;
use App\Models\AsignacionesAudit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AsignacionesAuditController extends Controller
{
    /*
    public function index()
    {
        abort_if(Gate::denies('inventarioprincipal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $inventarioprincipal = new Inventarioprincipal();
        $inventario = $inventarioprincipal->cat_tallas_prendas();
        return view('admin.inventarioprincipals.index', compact('inventario'));
    }

    public function create()
    {
        abort_if(Gate::denies('inventarioprincipal_audit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.inventarioprincipals_audit.create');
    }
*/
    public function store(StoreAsignacionesAuditRequest $request)
    {
        $inventarioprincipalaudit = AsignacionesAudit::create($request->all());

        return redirect()->route('admin.asignaciones_audit.index');
    }
    /*
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
        $response = $inventarioprincipal->updateCantidad($id, $cantidad);
        echo 'REQUESTS ' . $id . ' tiene cant=' . $cantidad . '<script>';
        echo 'console.log(' . json_encode($response) . ')';
        echo '</script>';

        //return redirect()->route('admin.inventarioprincipals.index');
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
    */
}
