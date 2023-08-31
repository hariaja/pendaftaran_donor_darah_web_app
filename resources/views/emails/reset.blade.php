<x-mail::message>
  <span class="h6 fw-bold mt-2 mb-4">
    {{ Helper::greeting() }}, {{ $user->name }}
  </span>

  <br>
  <br>

  <div class="mb-0">
    <span>
      {{ trans('Kami mendengar bahwa Anda kehilangan kata sandi Anda. Maaf tentang itu!') }}
    </span>
  </div>

  <div class="mb-3">
    <span>
      {{ trans('Tapi jangan khawatir! Anda dapat menggunakan tombol berikut untuk mengatur ulang kata sandi Anda:') }}
    </span>
  </div>

  <div class="my-4">
    <x-mail::button :url="$url">
      {{ trans('Atur Ulang Kata Sandi Anda') }}
    </x-mail::button>
  </div>

  <div class="mb-4">
    <span>
      {{ Illuminate\Support\Facades\Lang::get('Tautan pengaturan ulang kata sandi ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]) }}
    </span>
    <br>
    <span>
      {{ trans('Jika Anda tidak meminta pengaturan ulang kata sandi, tidak ada tindakan lebih lanjut yang diperlukan.') }}
    </span>
  </div>

  <br>

  {{ trans('Terimakasih') }},<br>
  {{ config('app.name') }}
</x-mail::message>
