@extends('layouts.app')
@section('title') {{ trans('page.roles.title') }} @endsection
@section('hero')
<div class="content content-full">
  <h2 class="content-heading">{{ trans('page.roles.title') }}</h2>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.roles.index') }}
      </h3>
      <div class="block-options">
        @can('roles.create')
          <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus fa-xs me-1"></i>
            {{ trans('page.roles.create') }}
          </a>
        @endcan
      </div>
    </div>
    <div class="block-content">

      <div class="my-3">
        {{ $dataTable->table() }}
      </div>

    </div>
  </div>
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  @vite('resources/js/settings/roles/index.js')
  <script>
    var urlDestroy = "{{ route('roles.destroy', ':uuid') }}"
  </script>
@endpush