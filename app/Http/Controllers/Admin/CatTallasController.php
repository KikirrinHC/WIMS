<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCatTallaRequest;
use App\Http\Requests\StoreCatTallaRequest;
use App\Http\Requests\UpdateCatTallaRequest;
//use App\Http\Requests\StoreInventarioprincipalRequest;
//use App\Http\Requests\UpdateInventarioprincipalRequest;
use App\Models\CatTalla;
use App\Models\CatTiposprenda;
use App\Models\Inventarioprincipal;
use App\Models\Almacen;
use App\Models\Sucursal;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CatTallasController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cat_talla_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catTallas = CatTalla::with(['tipoprenda'])->get();

        $cat_tiposprendas = CatTiposprenda::get();

        return view('admin.catTallas.index', compact('catTallas', 'cat_tiposprendas'));
    }

    public function create()
    {
        abort_if(Gate::denies('cat_talla_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $tipoprendas = CatTiposprenda::pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.catTallas.create', compact('tipoprendas'));
    }

    public function store(StoreCatTallaRequest $request)
    {


        $catTalla = CatTalla::create($request->all());

        //START Aquí se registra la talla creada en el inventario principal y se inicializa a 0

        Inventarioprincipal::create([
            'cantidad' => 0,
            'cat_tallas_id' => $catTalla->id,
            'cat_tiposprendas_id' => $catTalla->tipoprenda_id
        ]);
        //END

        //START Aquí se registra la talla creada en el almacen para cada sucursal que existe y se inicializa a 0

        $claseSucursal = new Sucursal();
        $existen = $claseSucursal->existenSucursales();
        if ($existen > 0) {
            $sucursales = $claseSucursal->getSucursales();
            foreach ($sucursales as $sucursal) {
                Almacen::create([
                    'cantidad' => 0,
                    'cat_tallas_id' => $catTalla->id,
                    'cat_tiposprendas_id' => $catTalla->tipoprenda_id,
                    'sucursals_id' => $sucursal
                ]);
            }
        }
        //END

        return redirect()->route('admin.cat-tallas.index');
    }

    public function edit(CatTalla $catTalla)
    {
        abort_if(Gate::denies('cat_talla_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tipoprendas = CatTiposprenda::pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        $catTalla->load('tipoprenda');

        return view('admin.catTallas.edit', compact('catTalla', 'tipoprendas'));
    }

    public function update(UpdateCatTallaRequest $request, CatTalla $catTalla)
    {
        $catTalla->update($request->all());

        return redirect()->route('admin.cat-tallas.index');
    }

    public function show(CatTalla $catTalla)
    {
        abort_if(Gate::denies('cat_talla_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catTalla->load('tipoprenda');

        return view('admin.catTallas.show', compact('catTalla'));
    }

    public function destroy(CatTalla $catTalla)
    {
        abort_if(Gate::denies('cat_talla_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $catTalla->delete();

        return back();
    }

    public function massDestroy(MassDestroyCatTallaRequest $request)
    {
        CatTalla::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
