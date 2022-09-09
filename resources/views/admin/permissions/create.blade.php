@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.permission.title_singular') }}
    </div>

    <div class="card-body">
<<<<<<< HEAD
        <form method="POST" action="{{ route('admin.permissions.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                    id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
=======
        <form method="POST" action="{{ route("admin.permissions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
<<<<<<< HEAD
                <label>{{ trans('cruds.permission.fields.module') }}</label>
                <select class="form-control {{ $errors->has('module') ? 'is-invalid' : '' }}" name="module" id="module">
                    <option value disabled {{ old('module', null)===null ? 'selected' : '' }}>{{
                        trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Permission::MODULE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('module', []) ? 'selected' : '' }}>{{ $label }}</option>
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
                <button class="btn btn-primary" type="submit">
=======
                <button class="btn btn-danger" type="submit">
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection