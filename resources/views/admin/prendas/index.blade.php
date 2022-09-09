@extends('layouts.admin')
@section('content')
@php
echo("<pre>");
    //print_r($prendas);
    echo("</pre>");
@endphp

@isset($message)
@if(count((array)$message) > 1)
<div class="alert alert-{{$message->type}} alert-dismissible fade show" role="alert">
    <h4 class="alert-heading">{{$message->title}}</h4>
    <p>{{$message->msj}}</p>
</div>
@endif
@endisset

<div class="card">
    <div class="card-header">
        Lista de prendas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Prendas">
                <thead>
                    <tr>
                        <th>
                            QR
                        </th>
                        <th>
                            Dias de uso
                        </th>
                        <th>
                            Estatus
                        </th>
                        <th>
                            Empleado
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>

                </thead>
                <tbody>
                    @foreach($prendas as $key => $prenda)
                    <tr data-entry-id="{{ $prenda->id }}">
                        <td>
                            {{ $prenda->qr ?? '' }}
                        </td>
                        <td>
                            {{ $prenda->dias_uso ?? '' }}
                        </td>
                        <td>
                            {{ $prenda->estatus ?? '' }}
                        </td>
                        <td>
                            {{ $prenda->nombre ?? '' }}
                        </td>
                        <td>
                            @can('prendas_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.prendas.show', $prenda->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('prendas_delete')
                            <form action="{{ route('admin.prendas.destroy', $prenda->id) }}" method="POST"
                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-md btn-danger"
                                    value="{{ trans('global.delete') }}"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)


        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[0, 'asc']],
            pageLength: 50,
        });
        let table = $('.datatable-Prendas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

        let visibleColumnsIndexes = null;
        $('.datatable thead').on('input', '.search', function () {
            let strict = $(this).attr('strict') || false
            let value = strict && this.value ? "^" + this.value + "$" : this.value

            let index = $(this).parent().index()
            if (visibleColumnsIndexes !== null) {
                index = visibleColumnsIndexes[index]
            }

            table
                .column(index)
                .search(value, strict)
                .draw()
        });
        table.on('column-visibility.dt', function (e, settings, column, state) {
            visibleColumnsIndexes = []
            table.columns(":visible").every(function (colIdx) {
                visibleColumnsIndexes.push(colIdx);
            });
        })
    })

</script>
@endsection