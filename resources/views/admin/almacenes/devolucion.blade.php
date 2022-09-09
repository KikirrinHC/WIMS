@extends('layouts.admin')
@section('content')

@php
/*
echo("<pre>");
    print_r($almacen);
    echo("</pre>");

*/
@endphp
<div class="card">
    <div class="card-header">
        {{ trans('cruds.almacen.title') }} - Devoluciones al inventario principal
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.almacenes.updateDevolucionToInventario', [$almacen->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label>Cantidad actual en almacén: {{ $almacen->cantidad }}
                prendas</label>

            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a devolver:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea devolver</span>
            </div>
            <div class="form-group">
                <label class="required" for="descripcion">Comentario</label>
                <textarea class="form-control" type="text" name="descripcion" id="descripcion" value=""
                    required></textarea>
                <span class="help-block">Indique una descripción por la cual devuelve las prendas</span>
            </div>


            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Devolver
                </button>
            </div>
            <input type="hidden" value="{{$almacen->cat_tallas_id}}" name="cat_tallas_id">
            <input type="hidden" value="{{$almacen->cat_tiposprendas_id}}" name="cat_tiposprendas_id">
        </form>
    </div>
</div>



@endsection