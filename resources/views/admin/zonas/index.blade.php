@extends('layouts.admin')
@section('content')
@can('zona_create')
<<<<<<< HEAD
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.zonas.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.zona.title_singular') }}
        </a>
    </div>
</div>
=======
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.zonas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.zona.title_singular') }}
            </a>
        </div>
    </div>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
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
<<<<<<< HEAD

=======
                        <th>
                            {{ trans('cruds.zona.fields.id') }}
                        </th>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
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
<<<<<<< HEAD
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
=======
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Zona::ENTIDAD_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Models\Zona::ESTATUS_RADIO as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($zonas as $key => $zona)
                        <tr data-entry-id="{{ $zona->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $zona->id ?? '' }}
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
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.zonas.show', $zona->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('zona_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.zonas.edit', $zona->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('zona_delete')
                                    <form action="{{ route('admin.zonas.destroy', $zona->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
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
<<<<<<< HEAD
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
=======
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('zona_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.zonas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-Zona:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
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
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d

</script>
@endsection