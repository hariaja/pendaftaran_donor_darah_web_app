<?php

namespace App\Helpers\Global;

use Illuminate\Http\Request;
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
   * Change format date to indonesian date.
   *
   * @param  mixed $date
   * @param  mixed $show_day
   * @return void
   */
  public static function parseDateTime($date, bool $show_day = true)
  {
    $date_name  = array(
      'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'
    );

    $month_name = array(
      1 =>
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $tahun = substr($date, 0, 4);
    $bulan = $month_name[(int) substr($date, 5, 2)];
    $tanggal = substr($date, 8, 2);
    $text = '';

    if ($show_day) {
      $urutan_hari = date('w', mktime(0, 0, 0, substr($date, 5, 2), $tanggal, $tahun));
      $hari = $date_name[$urutan_hari];
      $text .= "$hari, $tanggal $bulan $tahun";
    } else {
      $text .= "$tanggal $bulan $tahun";
    }

    return $text;
  }
}
