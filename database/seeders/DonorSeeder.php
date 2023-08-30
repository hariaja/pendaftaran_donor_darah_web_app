<?php

namespace Database\Seeders;

use App\Helpers\Enum\BloodType;
use App\Helpers\Enum\RoleType;
use Illuminate\Database\Seeder;
use App\Helpers\Enum\GenderType;
use App\Helpers\Enum\RhesusType;
use App\Helpers\Global\Helper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DonorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [
      [
        'name' => "Anita Rahayu Sutira",
        'email' => "anita@gmail.com",
        'phone' => "6285659466622",
        'nik' => "3321060902150009",
        'gender' => GenderType::FEMALE->value,
        'rhesus' => RhesusType::POSITIVE->value,
        'dob' => "1996-10-24",
        'job_title' => "Dokter",
        'address' => "Gg. Otto Iskandardinata No. 66 Magelang, Kalimantan Utara 13933",
        'role' => RoleType::DONOR->value,
        'blood_type' => 3,
      ],
    ];

    foreach ($users as $user) {
      Helper::createDonorUser(
        $user['name'],
        $user['email'],
        $user['phone'],
        $user['nik'],
        $user['gender'],
        $user['rhesus'],
        $user['dob'],
        $user['job_title'],
        $user['address'],
        $user['role'],
        $user['blood_type'],
      );
    }
  }
}
