<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyZonaRequest;
use App\Http\Requests\StoreZonaRequest;
use App\Http\Requests\UpdateZonaRequest;
use App\Models\Zona;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ZonasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('zona_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zonas = Zona::all();

        return view('admin.zonas.index', compact('zonas'));
    }

    public function create()
    {
        abort_if(Gate::denies('zona_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zonas.create');
    }

    public function store(StoreZonaRequest $request)
    {
        $zona = Zona::create($request->all());

        return redirect()->route('admin.zonas.index');
    }

    public function edit(Zona $zona)
    {
        abort_if(Gate::denies('zona_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zonas.edit', compact('zona'));
    }

    public function update(UpdateZonaRequest $request, Zona $zona)
    {
        $zona->update($request->all());

        return redirect()->route('admin.zonas.index');
    }

    public function show(Zona $zona)
    {
        abort_if(Gate::denies('zona_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zona->load('zonaSucursals');

        return view('admin.zonas.show', compact('zona'));
    }

    public function destroy(Zona $zona)
    {
        abort_if(Gate::denies('zona_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zona->delete();

        return back();
    }

    public function massDestroy(MassDestroyZonaRequest $request)
    {
        Zona::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
