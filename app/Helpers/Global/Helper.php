<?php

namespace App\Helpers\Global;

use App\Models\User;
use App\Models\Donor;
use Illuminate\Http\Request;
use App\Helpers\Enum\RoleType;
use Illuminate\Support\Carbon;
use App\Helpers\Enum\StatusActiveType;
use Illuminate\Support\Facades\Storage;

class Helper
{
  public const ALL = 'Semua Data';
  public const DEFAULT_PASSWORD = 'password';
  public const ADMIN_CONTACT = '6285798888733';

  /**
   * Helper to Upload Files.
   *
   * @return void
   */
  public static function uploadFile(
    Request $request,
    string $filePath,
    string $currentFilePath = null
  ) {
    if ($request->file('file')) {
      if ($currentFilePath) {
        Storage::delete($currentFilePath);
      }
      return Storage::putFile("public/{$filePath}", $request->file('file'));
    } elseif ($currentFilePath) {
      return $currentFilePath;
    } else {
      return null;
    }
  }

  /**
   * Get Profile View
   *
   * @param  User $user
   * @return void
   */
  public static function getProfileView(User $user)
  {
    if ($user->getRoleName() !== RoleType::DONOR->value) :
      return view('settings.profiles.officer', compact('user'));
    else :
      return view('settings.profiles.donor', compact('user'));
    endif;
  }

  /**
   * Get redirect user after update profile or update user
   *
   * @param  mixed $user
   * @return void
   */
  public static function getRedirectUpdateUser(User $user)
  {
    if (me()->id == $user->id) :
      return redirect(route('users.show', me()->uuid))->withSuccess(trans('Berhasil Memperbaharui Profil Anda'));
    endif;

    return redirect(route('users.index'))->withSuccess(trans('session.update'));
  }

  /**
   * Convert date of birth to age.
   *
   * @param  mixed $value
   * @return void
   */
  public static function convertToAge(string $value)
  {
    $currentDate = Carbon::now()->format('Y-m-d');
    $brithDate = Carbon::parse($value);
    $age = $brithDate->diffInYears($currentDate);
    return $age;
  }

  /**
   * Change format date to indonesian date.
   *
   * @param  mixed $date
   * @param  mixed $showDay
   * @return void
   */
  public static function parseDateTime($date, bool $showDay = true)
  {
    $dateName  = array(
      'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
    );

    $monthName = array(
      1 =>
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $year = substr($date, 0, 4);
    $month = $monthName[(int) substr($date, 5, 2)];
    $dateGen = substr($date, 8, 2);
    $text = '';

    if ($showDay) {
      $orderOfTheDay = date('w', mktime(0, 0, 0, substr($date, 5, 2), $dateGen, $year));
      $day = $dateName[$orderOfTheDay];
      $text .= "$day, $dateGen $month $year";
    } else {
      $text .= "$dateGen $month $year";
    }

    return $text;
  }

  /**
   * Create User Donor.
   *
   * @return void
   */
  public static function createDonorUser(
    $name,
    $email,
    $phone,
    $nik,
    $gender,
    $rhesus,
    $dob,
    $jobTitle,
    $address,
    $role,
    $bloodType
  ) {
    $user = User::create([
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'email_verified_at' => now(),
      'password' => bcrypt(self::DEFAULT_PASSWORD),
      'status' => StatusActiveType::ACTIVE->value,
    ])->assignRole($role);

    // Convert date of birth to age.
    $dateBrith = date('Y-m-d', strtotime($dob));
    $age = self::convertToAge($dateBrith);

    // Create donor data to database.
    Donor::create([
      'user_id' => $user->id,
      'blood_type_id' => $bloodType,
      'nik' => $nik,
      'gender' => $gender,
      'rhesus' => $rhesus,
      'dob' => $dob,
      'age' => $age,
      'job_title' => $jobTitle,
      'address' => $address,
    ]);

    return $user;
  }
}
