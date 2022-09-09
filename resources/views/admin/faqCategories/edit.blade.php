@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.faqCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-categories.update", [$faqCategory->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="category">{{ trans('cruds.faqCategory.fields.category') }}</label>
                <input class="form-control {{ $errors->has('category') ? 'is-invalid' : '' }}" type="text" name="category" id="category" value="{{ old('category', $faqCategory->category) }}" required>
                @if($errors->has('category'))
<<<<<<< HEAD
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
=======
                    <span class="text-danger">{{ $errors->first('category') }}</span>
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
                @endif
                <span class="help-block">{{ trans('cruds.faqCategory.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection