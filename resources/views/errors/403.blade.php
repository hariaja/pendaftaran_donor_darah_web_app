@extends('errors.layout')
@section('title', trans('Terlarang'))
@section('content')
<div class="hero bg-body-extra-light">
  <div class="hero-inner">
    <div class="content content-full">
      <img class="img-placeholder-center" src="{{ asset('assets/images/errors/403.jpg') }}" alt="Error 403" width="50%">
      <div class="py-4 text-center">
        <h1 class="fw-bold mt-5 mb-2">{{ trans('Oops.. Terjadi Kesalahan..') }}</h1>
        <h2 class="fs-4 fw-medium text-muted mb-5">{{ trans('Kami minta maaf tetapi Anda tidak memiliki izin untuk mengakses halaman ini..') }}</h2>
        <a class="btn btn-lg btn-alt-secondary" href="{{ route('home') }}">
          <i class="fa fa-arrow-left opacity-50 me-1"></i>
          {{ trans('Kembali Ke Beranda') }}
        </a>
      </div>
    </div>
  </div>
</div>
@endsection