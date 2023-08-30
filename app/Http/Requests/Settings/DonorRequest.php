<?php

namespace App\Http\Requests\Settings;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DonorRequest extends FormRequest
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
    return [
      'name' => 'required|string|max:50',
      'email' => [
        'required', 'email:dns',
        $this->method() === 'POST' ? Rule::unique('users', 'email') : Rule::unique('users', 'email')->ignore($this->donor->user_id),
      ],
      'phone' => [
        'required', 'numeric', 'min:12',
        $this->method() === 'POST' ? Rule::unique('users', 'phone') : Rule::unique('users', 'phone')->ignore($this->donor->user_id),
      ],
      'nik' => [
        'required', 'numeric', 'min:12',
        Rule::unique('donors', 'nik')->ignore($this->donor),
      ],
      'blood_type_id' => 'required|numeric',
      'dob' => 'required|date',
      'job_title' => 'required|string|max:30',
      'gender' => 'required|string',
      'rhesus' => 'required|string',
      'address' => 'required|string',
      'file' => 'nullable|mimes:jpg,png|max:3048',
    ];
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
      'birth_date' => 'Tanggal Lahir',
      'job_title' => 'Pekerjaan',
    ];
  }
}
