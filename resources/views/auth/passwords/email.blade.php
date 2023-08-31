@extends('layouts.guest')
@section('title', trans('Lupa Kata Sandi'))
@section('content')
<!-- Page Content -->
<div class="bg-gd-lake">
  <div class="hero-static content content-full bg-body-extra-light">
    <!-- Header -->
    <div class="py-4 px-1 text-center mb-4">
      <img src="{{ asset('assets/images/logo_dark.png') }}" alt="" width="20%">
      <h1 class="h3 fw-bold mt-5 mb-2">{{ trans('Reset Kata Sandi') }}</h1>
      <h2 class="h5 fw-medium text-muted mb-0">{{ trans('Harap berikan email atau Anda dan kami akan mengirimkan kata sandi Anda.') }}</h2>
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

        <form method="POST" action="{{ route('password.email') }}" onsubmit="return disableSubmitButton()">
          @csrf
          <div class="form-floating mb-4">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ trans('Alamat Email') }}">
            <label for="email" class="form-label">{{ trans('Alamat Email') }}</label>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4 space-y-2">
            <button type="submit" class="btn btn-lg btn-alt-primary w-100 py-3 fw-semibold" id="submit-button">
              {{ trans('Reset Password') }}
            </button>
            <a class="btn btn-alt-secondary w-100" href="{{ route('login') }}">
              {{ trans('Masuk Aplikasi') }}
            </a>
          </div>
        </form>
      </div>
    </div>
    <!-- END Reminder Form -->
  </div>
</div>
<!-- END Page Content -->
@endsection
