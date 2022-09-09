@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.permissions.update', [$permission->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                    id="title" value="{{ old('title', $permission->title) }}" required>
                @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.permission.fields.module') }}</label>
                <select class="form-control {{ $errors->has('module') ? 'is-invalid' : '' }}" name="module" id="module">
                    <option value disabled {{ old('module', null)===null ? 'selected' : '' }}>{{
                        trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Permission::MODULE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('module', $permission->module) === (string) $key ? 'selected' : ''
                        }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('module'))
                <div class="invalid-feedback">
                    {{ $errors->first('module') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.permission.fields.module_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection