<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySucursalRequest;
use App\Http\Requests\StoreSucursalRequest;
use App\Http\Requests\UpdateSucursalRequest;
use App\Models\Agencium;
use App\Models\Sucursal;
use App\Models\Almacen;
use App\Models\Zona;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SucursalController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sucursal_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sucursals = Sucursal::with(['agencia', 'zona'])->get();

        return view('admin.sucursals.index', compact('sucursals'));
    }

    public function create()
    {
        abort_if(Gate::denies('sucursal_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencias = Agencium::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zonas = Zona::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sucursals.create', compact('agencias', 'zonas'));
    }

    public function store(StoreSucursalRequest $request)
    {
        $sucursal = Sucursal::create($request->all());

        //START Aquí se crean los registros de cada talla en almacen para la sucursal creada
        $claseSucursal = new Sucursal();
        $claseSucursal->populateTallasEnAlmacen($sucursal->id);
        //END
        return redirect()->route('admin.sucursals.index');
    }

    public function edit(Sucursal $sucursal)
    {
        abort_if(Gate::denies('sucursal_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencias = Agencium::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $zonas = Zona::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sucursal->load('agencia', 'zona');

        return view('admin.sucursals.edit', compact('agencias', 'sucursal', 'zonas'));
    }

    public function update(UpdateSucursalRequest $request, Sucursal $sucursal)
    {
        $sucursal->update($request->all());

        return redirect()->route('admin.sucursals.index');
    }

    public function show(Sucursal $sucursal)
    {
        abort_if(Gate::denies('sucursal_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sucursal->load('agencia', 'zona');

        return view('admin.sucursals.show', compact('sucursal'));
    }

    public function destroy(Sucursal $sucursal)
    {
        abort_if(Gate::denies('sucursal_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sucursal->delete();

        return back();
    }

    public function massDestroy(MassDestroySucursalRequest $request)
    {
        Sucursal::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
