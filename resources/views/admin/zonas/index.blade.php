@extends('layouts.admin')
@section('content')
@can('zona_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.zonas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.zona.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.zona.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Zona">
                <thead>
                    <tr>
                        <th width="10">

                        </th>

                        <th>
                            {{ trans('cruds.zona.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.zona.fields.entidad') }}
                        </th>
                        <th>
                            {{ trans('cruds.zona.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($zonas as $key => $zona)
                    <tr data-entry-id="{{ $zona->id }}">
                        <td>

                        </td>

                        <td>
                            {{ $zona->nombre ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Zona::ENTIDAD_SELECT[$zona->entidad] ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Zona::ESTATUS_RADIO[$zona->estatus] ?? '' }}
                        </td>
                        <td>
                            @can('zona_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.zonas.show', $zona->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('zona_edit')
                            <a class="btn btn-md btn-info" href="{{ route('admin.zonas.edit', $zona->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('zona_delete')
                            <form action="{{ route('admin.zonas.destroy', $zona->id) }}" method="POST"
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
            pageLength: 10,
        });
        let table = $('.datatable-Zona:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection