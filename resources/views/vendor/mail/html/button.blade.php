@props([
  'url',
  'align' => 'center',
])

<div class="row">
  <div class="col-12">
    <div class="text-center">
      <a href="{{ $url }}" target="_blank" class="btn btn-primary" align="{{ $align }}">{{ $slot }}</a>
    </div>
  </div>
</div>
