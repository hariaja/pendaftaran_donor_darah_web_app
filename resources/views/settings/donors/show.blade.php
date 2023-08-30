<div class="modal fade" id="modal-show-donor" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popin" role="document">
    <div class="modal-content">
      <div class="block block-rounded shadow-none mb-0">
        <div class="block-header block-header-default">
          <h3 class="block-title"></h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>
        </div>
        <div class="block-content fs-sm">

          <div class="push mb-5">
            {{-- <img class="img-prev img-profile-center" src="{{ asset('assets/images/default.png') }}" alt=""> --}}
            <img class="img-prev img-profile-center" id="user-avatar" alt="">
          </div>

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('NIK') }}
              <span class="fw-semibold" id="donor-nik"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Nama') }}
              <span class="fw-semibold" id="donor-name"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Jenis Kelamin') }}
              <span class="fw-semibold" id="donor-gender"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Tanggal Lahir') }}
              <span class="fw-semibold" id="donor-dob"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Usia') }}
              <span class="fw-semibold" id="donor-age"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Pekerjaan') }}
              <span class="fw-semibold" id="donor-job"></span>
            </li>
          </ul>

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Email') }}
              <span class="fw-semibold" id="donor-email"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Telepon') }}
              <span class="fw-semibold" id="donor-phone"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Status Akun') }}
              <span class="fw-semibold" id="donor-status-account"></span>
            </li>
          </ul>

          <ul class="list-group push">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Golongan Darah') }}
              <span class="fw-semibold" id="blood-type"></span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              {{ trans('Rhesus') }}
              <span class="fw-semibold" id="blood-rhesus"></span>
            </li>
            <li class="list-group-item text-center">
              {{ trans('Alamat') }}
            </li>
            <li class="list-group-item text-center">
              <span class="fw-semibold" id="donor-address"></span>
            </li>
          </ul>

        </div>
        <div class="block-content block-content-full block-content-sm text-end border-top">
          <button type="button" class="btn btn-alt-secondary" data-bs-dismiss="modal">
            {{ trans('Close') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</div>