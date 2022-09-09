@extends('layouts.admin')
@section('content')
@can('sucursal_create')
<<<<<<< HEAD
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.sucursals.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.sucursal.title_singular') }}
        </a>
    </div>
</div>
=======
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sucursals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sucursal.title_singular') }}
            </a>
        </div>
    </div>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sucursal.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
<<<<<<< HEAD
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sucursal">
                <thead>
                    <tr>

                        <th>
                            {{ trans('cruds.sucursal.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.sucursal.fields.agencia') }}
                        </th>
                        <th>
                            {{ trans('cruds.sucursal.fields.estatus') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sucursals as $key => $sucursal)
                    <tr data-entry-id="{{ $sucursal->id }}">

                        <td>
                            {{ $sucursal->nombre ?? '' }}
                        </td>
                        <td>
                            {{ $sucursal->agencia->nombre ?? '' }}
                        </td>
                        <td>
                            {{ App\Models\Sucursal::ESTATUS_RADIO[$sucursal->estatus] ?? '' }}
                        </td>
                        <td>
                            @can('sucursal_show')
                            <a class="btn btn-md btn-primary" href="{{ route('admin.sucursals.show', $sucursal->id) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            @endcan

                            @can('sucursal_edit')
                            <a class="btn btn-md btn-info" href="{{ route('admin.sucursals.edit', $sucursal->id) }}">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            @endcan

                            @can('sucursal_delete')
                            <form action="{{ route('admin.sucursals.destroy', $sucursal->id) }}" method="POST"
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
=======
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Sucursal">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.sucursal.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.sucursal.fields.nombre') }}
                    </th>
                    <th>
                        {{ trans('cruds.sucursal.fields.agencia') }}
                    </th>
                    <th>
                        {{ trans('cruds.sucursal.fields.estatus') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($agencia as $key => $item)
                                <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\Sucursal::ESTATUS_RADIO as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
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
            order: [[0, 'asc']],
            pageLength: 10,
        });
        let table = $('.datatable-Sucursal:not(.ajaxTable)').DataTable({ buttons: dtButtons })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })
=======
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('sucursal_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sucursals.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.sucursals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'nombre', name: 'nombre' },
{ data: 'agencia_nombre', name: 'agencia.nombre' },
{ data: 'estatus', name: 'estatus' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 2, 'asc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Sucursal').DataTable(dtOverrideGlobals);
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
});
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d

</script>
@endsection