<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgenciumRequest;
use App\Http\Requests\StoreAgenciumRequest;
use App\Http\Requests\UpdateAgenciumRequest;
use App\Models\Agencium;
use App\Models\Empresa;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AgenciaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('agencium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencia = Agencium::with(['empresa'])->get();

        return view('admin.agencia.index', compact('agencia'));
    }

    public function create()
    {
        abort_if(Gate::denies('agencium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empresas = Empresa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.agencia.create', compact('empresas'));
    }

    public function store(StoreAgenciumRequest $request)
    {
        $agencium = Agencium::create($request->all());

        return redirect()->route('admin.agencia.index');
    }

    public function edit(Agencium $agencium)
    {
        abort_if(Gate::denies('agencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empresas = Empresa::pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $agencium->load('empresa');

        return view('admin.agencia.edit', compact('agencium', 'empresas'));
    }

    public function update(UpdateAgenciumRequest $request, Agencium $agencium)
    {
        $agencium->update($request->all());

        return redirect()->route('admin.agencia.index');
    }

    public function show(Agencium $agencium)
    {
        abort_if(Gate::denies('agencium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencium->load('empresa', 'agenciaSucursals');

        return view('admin.agencia.show', compact('agencium'));
    }

    public function destroy(Agencium $agencium)
    {
        abort_if(Gate::denies('agencium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agencium->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgenciumRequest $request)
    {
        Agencium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
