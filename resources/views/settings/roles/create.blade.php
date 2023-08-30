@extends('layouts.app')
@section('title') {{ trans('page.roles.title') }} @endsection
@section('hero')
<div class="content content-full">
  <div class="content-heading">
    <div class="d-flex justify-content-between align-items-sm-center">
      {{ trans('page.roles.title') }}
      <a href="{{ route('roles.index') }}" class="btn btn-sm btn-block-option text-danger">
        <i class="fa fa-xs fa-chevron-left me-1"></i>
        {{ trans('button.back') }}
      </a>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.roles.create') }}
    </h3>
  </div>
  <div class="block-content block-content-full">

    <form action="{{ route('roles.store') }}" method="POST" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">

          <div class="mb-4">
            <label class="form-label" for="name">{{ trans('Nama Peran') }}</label>
            <span class="text-danger">*</span>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" onkeypress="return hanyaHuruf(event)">
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        </div>
      </div>

      <div class="row mb-4">
        <div class="col-md-12">
          <div class="d-flex justify-content-between">
            <div class="space-y-2">
              <div class="form-check">
                <input type="checkbox" name="all_permission" id="all_permission" class="form-check-input @error('permission') is-invalid @enderror">
                <label for="all_permission" class="form-check-label">{{ trans('Pilih Semua Hak Akses') }}</label>
                @error('permission')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            <div class="">
              <span class="text-muted">
                {{ trans('Scroll untuk melihat lebih') }}
              </span>
            </div>
          </div>
        </div>
      </div>

      {{-- Row Block Content --}}
      <div class="row mb-4" id="data-temp"></div>

      <div class="ajax-load text-center mb-3" style="display:none">
        <i class="mdi mdi-48px mdi-spin mdi-loading"></i>
        <br>
        <span>{{ trans('Memuat...') }}</span>
      </div>

      {{-- No Data When Scrolling Done --}}
      <div class="no-data mb-4" style="display:none">
        <h6 class="text-center">
          {{ trans('Kami tidak memiliki lebih banyak data untuk ditampilkan (Last Page)') }}
        </h6>
      </div>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="mb-4">
            <button type="submit" class="btn btn-primary w-100" id="submit-button">
              <i class="fa fa-fw fa-circle-check opacity-50 me-1"></i>
              {{ trans('button.create') }}
            </button>
          </div>
        </div>
      </div>

    </form>

  </div>
</div>
@endsection
@push('javascript')
  <script>
    window.translations = @json(trans('permission'));
  </script>
  @vite('resources/js/settings/roles/input.js')
@endpush