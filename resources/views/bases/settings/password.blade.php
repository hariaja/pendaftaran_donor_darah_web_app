@extends('bases.layouts.app')
@section('title', trans('Ubah Kata Sandi'))
@section('hero')
<div class="bg-image" style="background-image: url('{{ asset('assets/images/bgpassword.png') }}');">
  <div class="bg-white-90">
    <div class="content text-center">
      <div class="pt-5 pb-3">
        <h1 class="h2 fw-bold text-black-75 mb-2">{{ trans('Ubah Kata Sandi') }}</h1>
        <h2 class="h5 fw-medium text-muted">{{ trans('Ubah kata sandi anda secara berkala untuk mengamankan Akun Anda') }}</h2>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="block block-rounded">
        <div class="block-content">
          <form action="{{ url('pendonor/users/password') }}" method="POST" onsubmit="return disableSubmitButton()">
            @csrf

            <div class="row items-push">
              <div class="col-lg-3">
                <p class="text-muted">
                  {{ trans('Mengubah kata sandi masuk Anda adalah cara mudah untuk menjaga keamanan akun Anda.') }}
                </p>
              </div>
              <div class="col-lg-7 offset-lg-1">
                <div class="mb-4 password-form">
                  <label class="form-label" for="current_password">{{ trans('Kata Sandi Saat Ini') }}</label>
                  <span class="text-danger">*</span>
                  <div class="input-group">
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                    <span class="input-group-text">
                      <i class="far fa-eye-slash toggle-password" style="cursor: pointer"></i>
                    </span>
                    @error('current_password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-4 password-form">
                  <label class="form-label" for="password">{{ trans('Kata Sandi Baru') }}</label>
                  <span class="text-danger">*</span>
                  <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                    <span class="input-group-text">
                      <i class="far fa-eye-slash toggle-password" style="cursor: pointer"></i>
                    </span>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="mb-4">
                  <label class="form-label" for="password_confirmation">{{ trans('Konfirmasi Kata Sandi Baru') }}</label>
                  <span class="text-danger">*</span>
                  <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                  @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-4">
                  <button type="submit" class="btn btn-alt-primary w-100" id="submit-button">
                    {{ trans('Ubah Kata Sandi') }}
                  </button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection