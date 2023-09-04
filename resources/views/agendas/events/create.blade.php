@extends('layouts.app')
@section('title', trans('page.events.title'))
@section('hero')
  <div class="content content-full">
    <div class="content-heading">
      <div class="d-flex justify-content-between align-items-sm-center">
        {{ trans('page.events.title') }}
        <a href="{{ route('events.index') }}" class="btn btn-sm btn-block-option text-danger">
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
        {{ trans('page.events.create') }}
      </h3>
    </div>
    <div class="block-content block-content-full">
      <form action="{{ route('events.store') }}" method="POST" onsubmit="return disableSubmitButton()">
        @csrf

        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="form-label" for="name">{{ trans('Nama Event') }}</label>
              <span class="text-danger">*</span>
              <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" onkeypress="return hanyaHuruf(event)" placeholder="{{ trans('etc. Pendaftaran Donor Darah') }}">
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div id="map" style="height: 400px;"></div>

            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat">
            </div>
          </div>
        </div>
      
      </form>
    </div>
  </div>
@endsection
@push('javascript')
  <script>
    var map = L.map('map').setView([-6.2088, 106.8456], 13); // Koordinat default (Jakarta)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    var marker = L.marker([-6.2088, 106.8456]).addTo(map); // Tambahkan marker default
    
    map.on('click', function(e) {
      // Dapatkan koordinat yang diklik
      var lat = e.latlng.lat;
      var lng = e.latlng.lng;
      
      // Perbarui input alamat dengan koordinat yang dipilih
      document.getElementById('address').value = lat + ', ' + lng;
      
      // Hapus marker yang ada dan tambahkan marker baru
      map.removeLayer(marker);
      marker = L.marker([lat, lng]).addTo(map);
    });
  </script>
@endpush
