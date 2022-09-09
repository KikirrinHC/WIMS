@extends('layouts.admin')
@section('content')
@can('asignacion_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.asignaciones.create') }}">
            Asignar prenda a un empleado
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.asignacion.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Asignaciones">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.asignacion.fields.qr') }}
                        </th>
                        <th>
                            {{ trans('cruds.asignacion.fields.empleado') }}
                        </th>

                        <th>
                            &nbsp;
                        </th>
                    </tr>

                </thead>
                <tbody>
                    @foreach($asignaciones as $key => $asignacione)
                    <tr data-entry-id="{{ $asignacione->id }}">
                        <td>
                            {{ $asignacione->qr ?? '' }}
                        </td>
                        <td>
                            {{ $asignacione->empleado->nombre ?? '' }}
                        </td>

                        <td>
                            @can('asignacion_show')
                            <a class="btn btn-md btn-primary"
                                href="{{ route('admin.asignaciones.show', $asignacione->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('asignacion_edit')
                            <a class="btn btn-md btn-info"
                                href="{{ route('admin.asignaciones.edit', $asignacione->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan
                            <a class="btn btn-md btn-warning"
                                href="{{ route('admin.asignaciones.change', $asignacione->id) }}">
                                <i class="fa-solid fa-rotate"></i>
                            </a>


                            @can('asignacion_delete')
                            <form action="{{ route('admin.asignaciones.destroy', $asignacione->id) }}" method="POST"
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
            order: [[2, 'asc']],
            pageLength: 50,
        });
        let table = $('.datatable-Asignaciones:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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