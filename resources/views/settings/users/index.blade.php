@extends('layouts.app')
@section('title', trans('page.users.title'))
@section('hero')
  <div class="content content-full">
    <h2 class="content-heading">{{ trans('page.users.title') }}</h2>
  </div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.users.index') }}
    </h3>
    <div class="block-options">
      @can('users.create')
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
          <i class="fa fa-plus fa-xs me-1"></i>
          {{ trans('Tambah Akun Petugas') }}
        </a>
      @endcan
    </div>
  </div>
  <div class="block-content">

    <div class="row">
      <div class="col-md-4">
        <div class="mb-4">
          <label for="status" class="form-label">{{ trans('Filter Berdasarkan Status Akun') }}</label>
          <select type="text" class="form-select" name="status" id="status">
            <option value="{{ Helper::ALL }}">{{ Helper::ALL }}</option>
            @foreach ($statusUserTypes as $item)
              <option value="{{ $item }}">{{ $item ? ucfirst('Active') : ucfirst('Inactive') }}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>

    <div class="my-3">
      {{ $dataTable->table() }}
    </div>

  </div>
</div>

@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  <script>
    var urlStatus = "{{ route('users.status', ':uuid') }}"
    var urlDestroy = "{{ route('users.destroy', ':uuid') }}"
  </script>
  @vite('resources/js/settings/users/index.js')
@endpush