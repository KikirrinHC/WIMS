<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCatTiposprendaRequest;
use App\Http\Requests\StoreCatTiposprendaRequest;
use App\Http\Requests\UpdateCatTiposprendaRequest;
use App\Models\CatTiposprenda;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CatTiposprendasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cat_tiposprenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catTiposprendas = CatTiposprenda::all();

        return view('admin.catTiposprendas.index', compact('catTiposprendas'));
    }

    public function create()
    {
        abort_if(Gate::denies('cat_tiposprenda_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.catTiposprendas.create');
    }

    public function store(StoreCatTiposprendaRequest $request)
    {
        $catTiposprenda = CatTiposprenda::create($request->all());

        return redirect()->route('admin.cat-tiposprendas.index');
    }

    public function edit(CatTiposprenda $catTiposprenda)
    {
        abort_if(Gate::denies('cat_tiposprenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.catTiposprendas.edit', compact('catTiposprenda'));
    }

    public function update(UpdateCatTiposprendaRequest $request, CatTiposprenda $catTiposprenda)
    {
        $catTiposprenda->update($request->all());

        return redirect()->route('admin.cat-tiposprendas.index');
    }

    public function show(CatTiposprenda $catTiposprenda)
    {
        abort_if(Gate::denies('cat_tiposprenda_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catTiposprenda->load('tipoprendaCatTallas');

        return view('admin.catTiposprendas.show', compact('catTiposprenda'));
    }

    public function destroy(CatTiposprenda $catTiposprenda)
    {
        abort_if(Gate::denies('cat_tiposprenda_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catTiposprenda->delete();

        return back();
    }

    public function massDestroy(MassDestroyCatTiposprendaRequest $request)
    {
        CatTiposprenda::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
