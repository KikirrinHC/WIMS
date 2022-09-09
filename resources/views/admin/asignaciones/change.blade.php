@extends('layouts.admin')
@section('content')
@php
echo("<pre>");
    // print_r($asignacion);
    echo("</pre>");
@endphp
<div id="messages">


    @isset($message)
    @if(count((array)$message) > 1)
    <div class="alert alert-{{$message->type}} alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">{{$message->title}}</h4>
        <p>{{$message->msj}}</p>
    </div>
    @endif
    @endisset
</div>

<div class="card">
    <div class="card-header">
        Cambio de prenda
    </div>

    <div class="card-body">
        <div class="mb-3">
            <button type="button" id="igual" name="igual" class="btn btn-secondary " value="">Cambio por prenda de
                igual
                talla</button>
            <button type="button" id="diferente" name="diferente" class="btn btn-dark" value="">Cambio por
                prenda
                de diferente talla</button>
        </div>

        <form method="POST" action="{{ route('admin.asignaciones.updateChange', [$asignacion->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="form-group" id="grupo-cat_tallas_id" name="grupo-cat_tallas_id" style="display: none">
                <label class="required" for="cat_tallas_id2">Talla:</label>
                <select disabled class="form-control {{ $errors->has('talla') ? 'is-invalid' : '' }}"
                    name="cat_tallas_id2" id="cat_tallas_id2" required>

                </select>
                @if($errors->has('talla'))
                <div class="invalid-feedback">
                    {{ $errors->first('talla') }}
                </div>
                @endif
                <span class="help-block">Seleccione una talla de la prenda</span>
            </div>
            <div class="form-group" id="grupo-qr" name="grupo-qr" style="display: none">
                <label class="required" for="qr">QR de la <b>nueva</b> prenda</label>
                <input class="form-control {{ $errors->has('qr') ? 'is-invalid' : '' }}" type="text" name="qr" id="qr"
                    value="{{ old('qr', '') }}" required>
                @if($errors->has('qr'))
                <div class="invalid-feedback">
                    {{ $errors->first('qr') }}
                </div>
                @endif
                <span class="help-block">Indique el QR de la nueva prenda</span>
            </div>
            <div class="form-group" id="grupo-descripcion" name="grupo-descripcion" style="display: none">
                <label class="required" for="descripcion">Comentario</label>
                <textarea class="form-control" type="text" name="descripcion" id="descripcion" value=""
                    required></textarea>
                <span class="help-block">Indique el motivo del cambio de prenda</span>
            </div>
            <div class="form-group" id="grupo-submit" name="grupo-submit" style="display: none">
                <button class="btn btn-primary" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
            <input type="hidden" value="" id="sucursals_id" name="sucursals_id">
            <input type="hidden" value="" id="empleado_id" name="empleado_id">
            <input type="hidden" value="" id="cat_tiposprendas_id" name="cat_tiposprendas_id">
            <input type="hidden" value="" id="cat_tallas_id" name="cat_tallas_id">
            <input type="hidden" value="" id="tipocambio" name="tipocambio">
        </form>


    </div>
</div>



@endsection
@section('scripts')
@parent
<script>

    $("#igual").click(function () {
        $("#messages").html('');

        $("#grupo-cat_tallas_id").css("display", "none");
        $("#grupo-qr").css("display", "none");
        $("#grupo-submit").css("display", "none");
        $.ajax({
            type: 'GET',
            url: '/api/v1/asignaciones/prendadisponible/{{$asignacion->id}}/0',
            success: function (resultado) {

                if (resultado) {
                    $("#sucursals_id").val('{{$asignacion->sucursals_id}}');
                    $("#empleado_id").val('{{$asignacion->empleado_id}}');
                    $("#cat_tiposprendas_id").val('{{$asignacion->cat_tiposprendas_id}}');
                    $("#cat_tallas_id").val('{{$asignacion->cat_tallas_id}}');
                    $("#grupo-qr").css("display", "");
                    $("#grupo-descripcion").css("display", "");
                    $("#grupo-submit").css("display", "");
                    $("#tipocambio").val("igual");
                } else {
                    $("#sucursals_id").val("");
                    $("#empleado_id").val("");
                    $("#cat_tiposprendas_id").val("");
                    $("#cat_tallas_id").val("");
                    $("#qr").val("");
                    $("#descripcion").val("");
                    $("#messages").html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><h4 class="alert-heading">Ocurrió un problema</h4><p>No se cuenta con prendas de la misma talla disponibles en el almacén</p></div>');
                }


            },
            error: function (resultado) { alert("Ocurrió un error inesperado") }
        });
    });
    $("#diferente").click(function () {
        $("#messages").html('');

        $("#grupo-cat_tallas_id").css("display", "none");
        $("#grupo-qr").css("display", "none");
        $("#grupo-descripcion").css("display", "none");
        $("#grupo-submit").css("display", "none");
        $.ajax({
            type: 'GET',
            url: '/api/v1/asignaciones/prendadisponible/{{$asignacion->id}}/{{$asignacion->cat_tallas_id}}',
            success: function (resultado) {

                if (resultado) {
                    $("#sucursals_id").val('{{$asignacion->sucursals_id}}');
                    $("#empleado_id").val('{{$asignacion->empleado_id}}');
                    $("#cat_tiposprendas_id").val('{{$asignacion->cat_tiposprendas_id}}');
                    $.ajax({
                        type: 'GET',
                        url: '/api/v1/asignaciones/tallasdisponibles/{{$asignacion->id}}/{{$asignacion->cat_tallas_id}}',
                        success: function (resultado) {
                            console.log(resultado);
                            $("#cat_tallas_id2").html("");
                            $("#cat_tallas_id2").attr("disabled", "disabled");
                            $("#cat_tallas_id2").append('<option value="" selected>Seleccione...</option>');
                            for (var i = 0; i < resultado.length; i++) {
                                $("#cat_tallas_id2").append('<option value="' + resultado[i]["id"] + '">' + resultado[i]["talla"] + '</option>');
                            }
                            $("#cat_tallas_id2").removeAttr("disabled");
                            $("#grupo-cat_tallas_id").css("display", "");
                            $("#grupo-qr").css("display", "");
                            $("#grupo-descripcion").css("display", "");
                            $("#grupo-submit").css("display", "");
                            $("#tipocambio").val("diferente");
                        },
                        error: function (resultado) { alert("Ocurrió un error inesperado") }
                    });

                } else {
                    $("#sucursals_id").val("");
                    $("#empleado_id").val("");
                    $("#cat_tiposprendas_id").val("");
                    $("#cat_tallas_id").val("");
                    $("#qr").val("");
                    $("#descripcion").val("");
                    $("#messages").html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><h4 class="alert-heading">Ocurrió un problema</h4><p>No se cuenta con prendas de diferente talla disponibles en el almacén</p></div>');
                }


            },
            error: function (resultado) { alert("Ocurrió un error inesperado") }
        });
    });


    $("#cat_tallas_id2").change(function () {
        if ($("#cat_tallas_id2").val() == "") {
            $("#cat_tallas_id").val("");

        } else {

            $("#cat_tallas_id").val($("#cat_tallas_id2").val());
        }
    });




</script>
@endsection