@extends('layouts.app')
@section('title') {{ trans('page.events.title') }} @endsection
@section('hero')
<div class="content content-full">
  <h2 class="content-heading">{{ trans('page.events.title') }}</h2>
</div>
@endsection
@section('content')
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">
        {{ trans('page.events.index') }}
      </h3>
      <div class="block-options">
        @can('events.create')
          <a href="{{ route('events.create') }}" class="btn btn-sm btn-primary">
            <i class="fa fa-plus fa-xs me-1"></i>
            {{ trans('page.events.create') }}
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

  @includeIf('agendas.events.show')
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  @vite('resources/js/agendas/events/index.js')
  <script>
    var urlShow = "{{ route('events.show', ':uuid') }}"
    var urlDestroy = "{{ route('events.destroy', ':uuid') }}"
  </script>
@endpush