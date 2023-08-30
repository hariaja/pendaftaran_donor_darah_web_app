<?php

namespace App\Http\Requests\Credentials;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    $rules = [
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email',
        Rule::unique('users', 'email'),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        Rule::unique('users', 'phone'),
      ],
      'nik' => [
        'required', 'numeric', 'min:16',
        Rule::unique('donors', 'nik'),
      ],
      'blood_type_id' => 'required|numeric',
      'dob' => 'required|date',
      'job_title' => 'required|string|max:30',
      'gender' => 'required|string',
      'address' => 'required|string',
      'password' => 'required|string|min:8|confirmed',
      'file' => 'nullable|mimes:jpg,png|max:3048',
    ];

    return $rules;
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   */
  public function messages(): array
  {
    return [
      'blood_type_id.required' => ':attribute tidak boleh dikosongkan',
      'blood_type_id.numeric' => ':attribute tidak valid',

      'name.required' => ':attribute tidak boleh dikosongkan',
      'name.string' => ':attribute tidak valid, masukkan yang benar',
      'name.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'nik.required' => ':attribute tidak boleh dikosongkan',
      'nik.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'nik.numeric' => ':attribute harus berupa angka',
      'nik.min' => ':attribute terlalu pendek, minimal :min karakter',

      'email.required' => ':attribute tidak boleh dikosongkan',
      'email.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'email.email' => ':attribute tidak valid, masukkan yang benar',

      'phone.required' => ':attribute tidak boleh dikosongkan',
      'phone.unique' => ':attribute sudah digunakan, silahkan pilih yang lain',
      'phone.numeric' => ':attribute harus berupa angka',
      'phone.min' => ':attribute terlalu pendek, minimal :min karakter',

      'gender.string' => ':attribute tidak valid, masukkan yang benar',
      'gender.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'address.required' => ':attribute tidak boleh dikosongkan',
      'address.string' => ':attribute tidak valid, masukkan yang benar',
      'address.max' => ':attribute terlalu panjang, maksimal :max karakter',

      'password.required' => ':attribute tidak boleh dikosongkan',
      'password.string' => ':attribute tidak valid, masukkan yang benar',
      'password.min' => ':attribute terlalu pendek, minimal :min karakter',
      'password.confirmed' => ':attribute konfimasi tidak sama',

      'file.image' => ':attribute tidak valid, pastikan memilih gambar',
      'file.mimes' => ':attribute tidak valid, masukkan gambar dengan format jpg atau png',
      'file.max' => ':attribute terlalu besar, maksimal :max kb',

      'birth_date.required' => ':attribute tidak boleh dikosongkan',
      'birth_date.date' => ':attribute harus berupa tanggal',

      'job_title.required' => ':attribute tidak boleh dikosongkan',
      'job_title.max' => ':attribute terlalu panjang, maksimal :max karakter',
    ];
  }

  /**
   * Get custom attributes for validator errors.
   *
   */
  public function attributes(): array
  {
    return [
      'blood_type_id' => 'Golongan Darah',
      'nik' => 'Nomor Induk Kependudukan',
      'name' => 'Nama Lengkap',
      'email' => 'Email',
      'phone' => 'Nomor Telepon',
      'gender' => 'Jenis Kelamin',
      'address' => 'Alamat lengkap',
      'file' => 'Avatar',
      'password' => 'Kata Sandi',
      'birth_date' => 'Tanggal Lahir',
      'job_title' => 'Pekerjaan',
    ];
  }
}
