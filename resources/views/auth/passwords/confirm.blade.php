@extends('layouts.app')

<<<<<<< HEAD
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    <div class="text-center mb-3">
                        {{ __('Please confirm your password before continuing.') }}
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if(Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
=======
@section('styles')
<style>
    .lockscreen-image-fallback {
        width: 70px;
        height: 70px;
        background: #3c8dbc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
    }
    input[type="password"], button {
        outline: none;
        box-shadow:none !important;
        border: 0;
    }
</style>
@endsection

@section('content')

<div class="lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="{{ route('admin.home') }}">
                {{ trans('panel.site_title') }}
            </a>
        </div>

        <div class="lockscreen-name">
            {{ auth()->user()->name ?? '' }}
        </div>

        <div class="lockscreen-item">
            <div class="lockscreen-image">
                {{-- <img src="https://adminlte.io/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Image"> --}}

                <div class="lockscreen-image-fallback text-uppercase text-white">
                    @if(auth()->user()->name)
                        {{ substr(auth()->user()->name, 0, 2) }}
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="lockscreen-credentials">
                @csrf

                <div class="input-group">
                    <input id="password" type="password" name="password" class="form-control" placeholder="{{ __('Confirm Password') }}" required>

                    <div class="input-group-append">
                        <button type="submit" class="btn">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @error('password')
            <div class="help-block text-center text-danger">
                {{ $message }}
            </div>
        @enderror

        <div class="help-block text-center">
            {{ __('Please confirm your password before continuing.') }}
        </div>

        <div class="text-center">
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    {{ trans('global.forgot_password') }}
                </a>
            @endif
>>>>>>> 2f6eb3e0138d7dca51bdac755494a0341fed929d
        </div>
    </div>
</div>

@endsection