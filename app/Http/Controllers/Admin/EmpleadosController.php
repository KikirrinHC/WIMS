<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyEmpleadoRequest;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;
use App\Models\Empleado;
use App\Models\Sucursal;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmpleadosController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('empleado_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::with(['sucursal'])->get();

        $sucursals = Sucursal::get();

        return view('admin.empleados.index', compact('empleados', 'sucursals'));
    }

    public function create()
    {
        abort_if(Gate::denies('empleado_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sucursals = Sucursal::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.empleados.create', compact('sucursals'));
    }

    public function store(StoreEmpleadoRequest $request)
    {
        $empleado = Empleado::create($request->all());

        return redirect()->route('admin.empleados.index');
    }

    public function edit(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sucursals = Sucursal::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $empleado->load('sucursal');

        return view('admin.empleados.edit', compact('empleado', 'sucursals'));
    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $empleado->update($request->all());

        return redirect()->route('admin.empleados.index');
    }

    public function show(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->load('sucursal', 'empleadoAsignaciones');

        return view('admin.empleados.show', compact('empleado'));
    }

    public function destroy(Empleado $empleado)
    {
        abort_if(Gate::denies('empleado_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleado->delete();

        return back();
    }

    public function massDestroy(MassDestroyEmpleadoRequest $request)
    {
        Empleado::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
