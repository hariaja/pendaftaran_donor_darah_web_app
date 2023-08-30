<?php

use App\Helpers\Enum\RoleType;
use App\Http\Controllers\Bases\Settings\DonorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\PasswordController;

$roles = RoleType::DONOR->value;

Route::middleware([
  'auth',
  'verified',
  "check.role:{$roles}"
])->group(function () {
  Route::prefix('pendonor')->group(function () {
    Route::name('donors.')->group(function () {
      // Beranda Pendonor
      Route::get('home', function () {
        return view('bases.home');
      })->name('home');

      // Profile & Password
      Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('password');
      Route::post('users/password', [PasswordController::class, 'store']);
      Route::resource('users', UserController::class)->only('show');
    });

    // Update
    Route::resource('donors', DonorController::class)->only('update');
  });
});
