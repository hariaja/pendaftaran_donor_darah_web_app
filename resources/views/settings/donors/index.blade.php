@extends('layouts.app')
@section('title', trans('page.donations.title'))
@section('hero')
  <div class="content content-full">
    <h2 class="content-heading">{{ trans('page.donations.title') }}</h2>
  </div>
@endsection
@section('content')
<div class="block block-rounded">
  <div class="block-header block-header-default">
    <h3 class="block-title">
      {{ trans('page.donations.index') }}
    </h3>
  </div>
  <div class="block-content">

    <div class="my-3">
      {{ $dataTable->table() }}
    </div>

  </div>
</div>
@includeIf('settings.donors.show')
@endsection
@push('javascript')
  {{ $dataTable->scripts() }}
  <script>
    var urlShow = "{{ route('donations.show', ':uuid') }}"
    var urlStatus = "{{ route('users.status', ':uuid') }}"
    var urlDestroy = "{{ route('donations.destroy', ':uuid') }}"
  </script>
  @vite('resources/js/settings/donors/index.js')
@endpush