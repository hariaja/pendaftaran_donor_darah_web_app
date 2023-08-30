@extends('layouts.guest')
@section('title', trans('page.register.title'))
@section('content')
<div class="bg-gd-dusk">
  <div class="hero-static content content-full bg-body-extra-light">

    <!-- Header -->
    <div class="py-4 px-1 text-center mb-4">
      <img src="{{ asset('assets/images/logo_dark.png') }}" alt="" width="20%">
      <h1 class="h3 fw-bold mt-5 mb-2">{{ trans('page.register.title') }}</h1>
      <h2 class="h5 fw-medium text-muted mb-0">{{ trans('page.register.subtitle') }}</h2>
    </div>
    <!-- END Header -->

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
      @csrf

      <div class="row justify-content-center px-1">
        <div class="col-sm-8 col-md-6 col-xl-7">

          <div class="block block-bordered block-rounded mb-4">
            <div class="block-header">
              <h3 class="block-title">
                {{ trans('Informasi Data Diri') }}
              </h3>
            </div>
            <div class="block-content">
  
              <div class="form-floating mb-4">
                <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" onkeypress="return onlyNumber(event)" placeholder="{{ trans('Nomor Induk Kependudukan') }}">
                <label for="nik" class="form-label">{{ trans('Nomor Induk Kependudukan') }}</label>
                @error('nik')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="form-floating mb-4">
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" onkeypress="return onlyLetter(event)" placeholder="{{ trans('Nama Lengkap') }}">
                <label for="name" class="form-label">{{ trans('Nama Lengkap') }}</label>
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-floating mb-4">
                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Floating label select gender">
                  <option selected disabled>{{ trans('Pilih Salah Satu') }}</option>
                  @foreach ($genders as $gender)
                    <option value="{{ $gender }}" @if(old('gender') === $gender) selected @endif>{{ ucfirst($gender) }}</option>
                  @endforeach
                </select>
                @error('gender')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label class="form-label" for="gender">{{ trans('Jenis Kelamin') }}</label>
              </div>
  
              <div class="form-floating mb-4">
                <input type="text" class="js-flatpickr form-control @error('dob') is-invalid @enderror" id="dob" name="dob" min="{{ date('Y-m-d') }}" placeholder="{{ trans('Select Tanggal Lahir') }}" value="{{ old('dob') }}">
                <label for="dob" class="form-label">{{ trans('Tanggal Lahir') }}</label>
                @error('dob')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-floating mb-4">
                <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}" onkeypress="return hanyaHuruf(event)" placeholder="{{ trans('Pekerjaan Saat Ini') }}">
                @error('job_title')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="job_title" class="form-label">{{ trans('Pekerjaan Saat Ini') }}</label>
              </div>

              <div class="mb-4">
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
                <input class="form-control form-control-lg @error('avatar') is-invalid @enderror" type="file" accept="image/*" id="image" name="file" onchange="return previewImage()">
                @error('file')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
              <div class="form-floating mb-4">
                <textarea name="address" id="address" style="height: 200px" class="form-control @error('address') is-invalid @enderror" placeholder="{{ trans('Alamat Lengkap') }}">{{ old('address') }}</textarea>
                <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
                @error('address')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
            </div>
          </div>

          <div class="block block-bordered block-rounded mb-4">
            <div class="block-header">
              <h3 class="block-title">
                {{ trans('Informasi Donor Darah') }}
              </h3>
            </div>
            <div class="block-content">
  
              <div class="form-floating mb-4">
                <select class="form-select @error('blood_type_id') is-invalid @enderror" id="blood_type_id" name="blood_type_id" aria-label="Floating label select blood">
                  <option selected disabled>{{ trans('Pilih Salah Satu') }}</option>
                  @foreach ($bloods as $item)
                    <option value="{{ $item->id }}" @if(old('blood_type_id') === $item) selected @endif>{{ ucfirst($item->type) }}</option>
                  @endforeach
                </select>
                @error('blood_type_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label class="form-label" for="blood_type_id">{{ trans('Golongan Darah') }}</label>
              </div>
  
              <div class="form-floating mb-4">
                <select class="form-select @error('rhesus') is-invalid @enderror" id="rhesus" name="rhesus" aria-label="Floating label select rhesus">
                  <option selected disabled>{{ trans('Pilih Salah Satu') }}</option>
                  @foreach ($rhesus as $item)
                    <option value="{{ $item }}" @if(old('rhesus') === $item) selected @endif>{{ ucfirst($item) }}</option>
                  @endforeach
                </select>
                @error('rhesus')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label class="form-label" for="rhesus">{{ trans('Rhesus') }}</label>
              </div>
  
            </div>
          </div>

          <div class="block block-bordered block-rounded mb-4">
            <div class="block-header">
              <h3 class="block-title">
                {{ trans('Informasi Kredensial') }}
              </h3>
            </div>
            <div class="block-content">
  
              <div class="form-floating mb-4">
                <input type="text" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" oninput="formatPhoneNumber()" placeholder="{{ trans('No. Telepon Aktif') }}">
                @error('phone')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="phone" class="form-label">{{ trans('No. Telepon') }}</label>
              </div>
  
              <div class="form-floating mb-4">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email" required>
                <label class="form-label" for="email">{{ trans('Email') }}</label>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
    
              <div class="form-floating mb-4 password-form">
                <i class="icon far fa-eye-slash fa-lg toggle-password"></i>
                <input type="password" class="form-control" id="password" name="password" autocomplete="current-password" placeholder="Password" required>
                <label class="form-label" for="password">{{ trans('Password') }}</label>
              </div>
    
              <div class="form-floating mb-4">
                <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ trans('Konfirmasi Password') }}">
                <label for="password_confirmation" class="form-label">{{ trans('Konfirmasi Password') }}</label>
                @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
  
            </div>
          </div>

          <div class="row g-sm mb-4">
            <div class="col-12">
              <div class="text-center my-4">
                <button type="submit" class="btn btn-lg btn-alt-primary w-100 py-3 fw-semibold" id="submit-button">
                  {{ trans('page.register.button') }}
                </button>
              </div>
            </div>
            <div class="my-3">
              <div class="divider-container">
                <div class="divider-line"></div>
                <div class="divider-text fw-bold">{{ trans('Atau') }}</div>
                <div class="divider-line"></div>
              </div>
            </div>
            <div class="text-center">
              <a href="{{ route('login') }}" class="link-fx fw-bold">{{ trans('page.register.login_link') }}</a>
            </div>
          </div>

        </div>
      </div>

    </form>

  </div>
</div>
@endsection
