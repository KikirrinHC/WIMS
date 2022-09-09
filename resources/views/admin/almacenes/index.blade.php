@extends('layouts.admin')
@section('content')


@php
/*echo("--------<pre>");
    print_r($almacen);
    echo("</pre>");
*/
@endphp

@if ( $almacen == new stdClass() )
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">No existen almacenes</h4>
    <p>Verifique que ha creado las sucursales.</p>

    <a class="btn btn-md btn-dark" href="{{ route('admin.almacenes.populate',  [1]) }}">
        Recrear almacenes
    </a>

</div>

@else
<div class="card">
    <div class="card-header">
        {{ trans('cruds.almacen.title') }}
    </div>


    <div class="card-body">


    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Almacenes">
                <thead>
                    <tr>
                        <th>
                            Almacen
                        </th>

                        @php
                        $data=reset($almacen);
                        /* echo("--------<pre>");
                            print_r($data->inventario);
                            echo("</pre>");
                        */ @endphp
                        @foreach($data->inventario as $key2 => $inv)
                        <th>
                            {{$key2}}
                        </th>
                        @endforeach

                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($almacen as $key => $alm)
                    @php
                    /* echo("--------<pre>");
                        print_r($alm);
                        echo("</pre>");*/
                    @endphp


                    <tr data-entry-id="{{ $alm->sucursals_id }}">
                        <td>
                            {{ $alm->nombre ?? '' }}
                        </td>
                        @php
                        $inventario = $alm->inventario;
                        @endphp
                        @foreach($inventario as $key2 => $inv)
                        <td>

                            {{ $inv ?? '' }}

                        </td>
                        @endforeach

                        <td>
                            @can('almacen_show')
                            <a class="btn btn-md btn-primary"
                                href="{{ route('admin.almacenes.show',  $alm->sucursals_id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan
                            @can('almacen_edit')



                            @endcan
                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endif


@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[2, 'asc']],
            pageLength: 10,
        });
        let table = $('.datatable-Almacenes:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection