<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrendaRequest;
use App\Http\Requests\UpdatePrendaRequest;
use App\Models\Prenda;

use Gate;

use stdClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrendasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('prenda_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $classPrendas=new Prenda();
        $prendas = $classPrendas->getPrendas();


        return view('admin.prendas.index', compact('prendas'));
    }

    public function create()
    {
        abort_if(Gate::denies('prenda_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.prendas.create');
    }

    public function store(StorePrendaRequest $request)
    {
        $prenda = Prenda::create($request->all());
        return redirect()->route('admin.prendas.index');
    }

    public function edit(Prenda $prenda)
    {
        abort_if(Gate::denies('prenda_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return view('admin.prendas.edit', compact('prenda'));
    }


    public function update(UpdatePrendaRequest $request, Prenda $prenda)
    {

        $prenda->update($request->all());

        return redirect()->route('admin.prendas.index');
    }



    public function show(Prenda $prenda)
    {
        abort_if(Gate::denies('asignacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prenda->load('asignacion');

        return view('admin.asignaciones.show', compact('prenda'));
    }

    public function destroy(Prenda $prenda)
    {
        abort_if(Gate::denies('asignacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prenda->delete();

        return back();
    }
}
