@extends('layouts.guest')
@section('title', trans('Ubah Kata Sandi'))
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="bg-gd-lake">
  <div class="hero-static content content-full bg-body-extra-light">
    <!-- Header -->
    <div class="py-4 px-1 text-center mb-4">
      <img src="{{ asset('assets/images/logo_dark.png') }}" alt="" width="20%">
      <h1 class="h3 fw-bold mt-5 mb-2">{{ trans('Reset Kata Sandi') }}</h1>
      <h2 class="h5 fw-medium text-muted mb-0">{{ trans('Silahkan masukkan kata sandi baru anda pada form di bawah ini.') }}</h2>
    </div>
    <!-- END Header -->

    <!-- Reminder Form -->
    <div class="row justify-content-center px-1">
      <div class="col-sm-8 col-md-6 col-xl-4">

        @if (session('status'))
          <div class="mb-4">
            @include('components.alert-success')
          </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" onsubmit="return disableSubmitButton()">
          @csrf
          <input type="hidden" name="token" value="{{ $token }}">

          <div class="form-floating mb-4">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus readonly placeholder="{{ trans('Alamat Email') }}">
            <label for="email" class="form-label">{{ trans('Alamat Email') }}</label>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-4 password-form">
            <i class="icon far fa-eye-slash fa-lg toggle-password"></i>
            <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" placeholder="Password" required>
            <label class="form-label" for="password">{{ trans('Password') }}</label>
          </div>

          <div class="form-floating mb-4 password-form">
            <i class="icon far fa-eye-slash fa-lg toggle-password"></i>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('Password') }}" required>
            <label class="form-label" for="password_confirmation">{{ trans('Konfirmasi Kata Sandi') }}</label>
          </div>

          <div class="mb-4 space-y-2">
            <button type="submit" class="btn btn-lg btn-alt-primary w-100 py-3 fw-semibold" id="submit-button">
              {{ trans('Atur Ulang Kata Sandi') }}
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- END Reminder Form -->
  </div>
</div>
@endsection
