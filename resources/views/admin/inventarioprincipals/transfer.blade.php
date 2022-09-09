@extends('layouts.admin')
@section('content')

@php
/*
echo("<pre>");
    print_r($almacenes);
    echo("</pre>");


echo("--------<pre>");
    print_r($inventario);
    echo("</pre>");
*/
@endphp
<div class="card">
    <div class="card-header">
        {{ trans('cruds.inventarioprincipal.title') }} - Transferencias a un almacén
    </div>

    <div class="card-body">
        <form method="POST"
            action="{{ route('admin.inventarioprincipals.updateTransferToAlmacen', [$inventario->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <label>Cantidad actual en Inventario principal: {{ $inventario->cantidad }}
                prendas</label>

            <div class="form-group">
                <label class="required" for="cantidad">Cantidad a transferir:</label>
                <input class="form-control" type="text" name="cantidad" id="cantidad" value="" required>
                <span class="help-block">Indique la cantidad de prendas que desea transferir</span>
            </div>
            <div class="form-group">
                <label>Almacén que recibe</label>
                <select class="form-control" name="recibe" id="recibe">
                    <option value>{{
                        trans('global.pleaseSelect') }}</option>
                    @foreach($almacenes as $key => $almacen)

                    <option value="{{ $almacen->sucursals_id }}">{{ $almacen->nombre }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <label class="required" for="descripcion">Comentario</label>
                <textarea class="form-control" type="text" name="descripcion" id="descripcion" value=""
                    required></textarea>
                <span class="help-block">Indique una descripción por la cual transfiere las prendas</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    Transferir
                </button>
            </div>
            <input type="hidden" value="{{$inventario->cat_tallas_id}}" name="cat_tallas_id">
            <input type="hidden" value="{{$inventario->cat_tiposprendas_id}}" name="cat_tiposprendas_id">
        </form>
    </div>
</div>



@endsection