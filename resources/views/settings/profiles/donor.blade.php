@extends('bases.layouts.app')
@section('title', 'Ubah Data Diri Anda')
@section('hero')
<div class="bg-image bg-image-top" style="background-image: url('{{ asset('assets/images/bgprofile.png') }}');">
  <div class="bg-white-90">
    <div class="content text-center">
      <div class="pt-5 pb-3">
        <h1 class="h2 fw-bold text-black-75 mb-2">{{ trans('Ubah Data Diri Anda') }}</h1>
        <h2 class="h5 fw-medium text-muted">{{ trans('Anda bisa mengubah informasi seputar diri anda!') }}</h2>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="block block-rounded">
        <div class="block-content">
          <form action="{{ route('donors.update', $user->donor->uuid) }}" method="POST" enctype="multipart/form-data" onsubmit="return disableSubmitButton()">
            @csrf
            @method('PATCH')

            <div class="row items-push justify-content-center">
              <div class="col-md-6">

                <div class="mb-4">
                  <label for="nik" class="form-label">{{ trans('Nomor Induk Kependudukan') }}</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $user->donor->nik) }}" onkeypress="return hanyaAngka(event)" placeholder="Input Nomor Induk Kependudukan">
                  @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label class="form-label" for="name">{{ trans('Nama') }}</label>
                  <span class="text-danger">*</span>
                  <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ trans('Masukkan nama anda') }}" value="{{ old('name', $user->name) }}" onkeypress="return onlyLetter(event)">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label class="form-label" for="email">{{ trans('Email') }}</label>
                  <span class="text-danger">*</span>
                  <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ trans('Masukkan alamat email') }}" value="{{ old('email', $user->email) }}" readonly>
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="phone" class="form-label">{{ trans('No. Handphone') }}</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" oninput="formatPhoneNumber()" placeholder="{{ trans('Masukkan no. handphone') }}">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row mb-4">
                  <div class="col-md-10 col-xl-6">
                    <div class="push">
                      <img class="img-avatar img-prev" src="{{ $user->getUserAvatar() }}" alt="">
                    </div>
                    <div class="">
                      <label class="form-label" for="image" class="form-label">{{ trans('Pilih Avatar Baru') }}</label>
                      <input class="form-control" type="file" id="image" name="file" accept="image/*" onchange="return previewImage()">
                    </div>
                  </div>
                </div>

                <div class="mb-4">
                  <label class="form-label" for="gender">{{ trans('Jenis Kelamin') }}</label>
                  <span class="text-danger">*</span>
                  <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Floating label select gender">
                    <option selected disabled>{{ trans('Pilih Salah Satu') }}</option>
                    @foreach ($genders as $gender)
                      <option value="{{ $gender }}" @if(old('gender', $user->donor->gender) === $gender) selected @endif>{{ ucfirst($gender) }}</option>
                    @endforeach
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="mb-4">
                      <label for="blood_type_id" class="form-label">{{ trans('Golongan Darah') }}</label>
                      <select name="blood_type_id" id="blood_type_id" class="js-select2 form-select @error('blood_type_id') is-invalid @enderror" data-placeholder="{{ trans('Pilih Golongan Darah') }}" style="width: 100%;">
                        <option></option>
                        @foreach ($bloods as $item)
                          @if (old('blood_type_id', $user->donor->blood_type_id) == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->type }}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->type }}</option>
                          @endif
                        @endforeach
                      </select>
                      @error('blood_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md">
                    <div class="mb-4">
                      <label for="rhesus" class="form-label">{{ trans('Rhesus') }}</label>
                      <select name="rhesus" id="rhesus" class="form-select @error('rhesus') is-invalid @enderror">
                        <option disabled selected>{{ trans('Pilih Rhesus') }}</option>
                        @foreach ($rhesus as $item)
                          <option value="{{ $item }}" @if(old('rhesus', $user->donor->rhesus) === $item) selected @endif>{{ ucfirst($item) }}</option>
                        @endforeach
                      </select>
                      @error('rhesus')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="dob" class="form-label">{{ trans('Tanggal Lahir') }}</label>
                  <span class="text-danger">*</span>
                  <input type="text" class="js-flatpickr form-control @error('dob') is-invalid @enderror" id="dob" name="dob" min="{{ date('Y-m-d') }}" placeholder="{{ trans('Pilih Tanggal Lahir') }}" value="{{ old('dob', $user->donor->dob) }}">
                  @error('dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="job_title" class="form-label">{{ trans('Pekerjaan Saat Ini') }}</label>
                  <span class="text-danger">*</span>
                  <input type="text" name="job_title" id="job_title" class="form-control @error('job_title') is-invalid @enderror" value="{{ old('job_title', $user->donor->job_title) }}" onkeypress="return hanyaHuruf(event)" placeholder="{{ trans('Pekerjaan Saat Ini') }}">
                  @error('job_title')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <label for="address" class="form-label">{{ trans('Alamat Lengkap') }}</label>
                  <textarea name="address" id="address" cols="30" rows="4" class="form-control @error('address') is-invalid @enderror" placeholder="Input Alamat">{{ old('address', $user->donor->address) }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-4">
                  <button type="submit" class="btn btn-primary w-100" id="submit-button">
                    {{ trans('button.edit') }}
                  </button>
                </div>

              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection