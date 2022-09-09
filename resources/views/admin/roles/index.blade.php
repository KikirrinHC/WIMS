@extends('layouts.admin')
@section('content')
@php
/*echo("<pre>");
    print_r($roles);
    echo("<pre>");*/
        @endphp

        @can('role_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.roles.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.role.title_singular') }}
                </a>
            </div>
        </div>
        @endcan
        <div class="card">
            <div class="card-header">
                {{ trans('cruds.role.title_singular') }} {{ trans('global.list') }}
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                        <thead>
                            <tr>

                                <th>
                                    {{ trans('cruds.role.fields.title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.role.fields.permissions') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key => $role)
                            @php
                            $superadmin=false;
                            if($role->title=="Superadmin"){
                            $superadmin=true;
                            }
                            @endphp
                            <tr data-entry-id="{{ $role->id }}">

                                <td>
                                    {{ $role->title ?? '' }}
                                </td>
                                <td>
                                    @foreach($role->permissions as $key => $item)

                                    @if ($item->title=='profile_password_edit')
                                    <span class="badge badge-success">
                                        @elseif ($item->module=='usuarios')
                                        <span class="badge badge-danger">
                                            @elseif ($item->module=='auditoría')
                                            <span class="badge badge-warning">
                                                @else
                                                <span class="badge badge-info">
                                                    @endif
                                                    {{ $item->title }}</span>
                                                @endforeach
                                </td>
                                <td>
                                    @can('role_show')
                                    <a class="btn btn-md btn-primary" href="{{ route('admin.roles.show', $role->id) }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @endcan
                                    @if(!$superadmin=="Superadmin")
                                    @can('role_edit')
                                    <a class="btn btn-md btn-info" href="{{ route('admin.roles.edit', $role->id) }}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                    @endcan

                                    @can('role_delete')
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-md btn-danger"
                                            value="{{ trans('global.delete') }}"><i
                                                class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                    @endcan
                                    @endif
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
                let table = $('.datatable-Role:not(.ajaxTable)').DataTable({ buttons: dtButtons })
                $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
                });

            })

        </script>
        @endsection