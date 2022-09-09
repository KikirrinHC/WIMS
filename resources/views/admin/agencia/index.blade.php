@extends('layouts.admin')
@section('content')
@can('agencium_create')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.agencia.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.agencium.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.agencium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Agencium">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.agencium.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.agencium.fields.empresa') }}
                        </th>
                        <th>
                            {{ trans('cruds.agencium.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agencia as $key => $agencium)
                    <tr data-entry-id="{{ $agencium->id }}">
                        <td>
                            {{ $agencium->nombre ?? '' }}
                        </td>
                        <td>
                            {{ $agencium->empresa->nombre ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Agencium::ESTATUS_RADIO[$agencium->estatus] ?? '' }}
                        </td>
                        <td>
                            @can('agencium_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.agencia.show', $agencium->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('agencium_edit')
                            <a class="btn btn-md btn-info" href="{{ route('admin.agencia.edit', $agencium->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('agencium_delete')
                            <form action="{{ route('admin.agencia.destroy', $agencium->id) }}" method="POST"
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
        let table = $('.datatable-Agencium:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection