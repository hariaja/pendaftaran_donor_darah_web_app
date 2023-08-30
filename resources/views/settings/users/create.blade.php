@extends('layouts.app')
@section('title') {{ trans('page.users.title') }} @endsection
@section('hero')
<div class="content content-full">
  <h2 class="content-heading">
    <div class="d-flex justify-content-between align-items-sm-center">
      {{ trans('page.users.title') }}
      <a href="{{ route('users.index') }}" class="btn btn-sm btn-block-option text-danger">
        <i class="fa fa-xs fa-chevron-left me-1"></i>
        {{ trans('button.back') }}
      </a>
    </div>
  </h2>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.users.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">
    <form action="{{ route('users.store') }}" method="POST" onsubmit="return disableSubmitButton()" enctype="multipart/form-data">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="mb-4">
            <label for="name" class="form-label">{{ trans('Nama') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="{{ trans('Nama Lengkap') }}" onkeypress="return hanyaHuruf(event)">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <label for="email" class="form-label">{{ trans('Email') }}</label>
            <span class="text-danger">*</span>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="{{ trans('Alamat Email') }}">
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <label for="phone" class="form-label">{{ trans('No. Telepon') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" oninput="formatPhoneNumber()" placeholder="{{ trans('No. Telepon Aktif') }}">
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <label for="roles" class="form-label">{{ trans('Role') }}</label>
            <input type="text" name="roles" id="roles" value="{{ old('roles', $roles->name) }}" class="form-control @error('roles') is-invalid @enderror" placeholder="{{ trans('Input Role') }}" onkeypress="return hanyaHuruf(event)" readonly>
            @error('roles')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-0">
            <div class="block block-rounded">
              <div class="block-header block-header-default">
                <label class="form-label">{{ trans('button.image') }}</label>
              </div>
              <div class="block-content">
                <div class="push">
                  <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label" for="image">{{ trans('Upload Avatar') }}</label>
            <input class="form-control @error('file') is-invalid @enderror" type="file" accept="image/*" id="image" name="file" onchange="return previewImage()">
            @error('file')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check me-1"></i>
              {{ trans('button.create') }}
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection