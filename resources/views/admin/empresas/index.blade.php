@extends('layouts.admin')
@section('content')
@can('empresa_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.empresas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.empresa.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.empresa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Empresa">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.empresa.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.empresa.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($empresas as $key => $empresa)
                    <tr data-entry-id="{{ $empresa->id }}">

                        <td>
                            {{ $empresa->nombre ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Empresa::ESTATUS_RADIO[$empresa->estatus] ?? '' }}
                        </td>
                        <td>
                            @can('empresa_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.empresas.show', $empresa->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('empresa_edit')
                            <a class="btn btn-md btn-info" href="{{ route('admin.empresas.edit', $empresa->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('empresa_delete')
                            <form action="{{ route('admin.empresas.destroy', $empresa->id) }}" method="POST"
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
            pageLength: 10,
        });
        let table = $('.datatable-Empresa:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection