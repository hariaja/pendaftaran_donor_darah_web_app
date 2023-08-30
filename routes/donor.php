<?php

use App\Helpers\Enum\RoleType;
use Illuminate\Support\Facades\Route;

$roles = RoleType::DONOR->value;

Route::middleware([
  'auth',
  'verified',
  "check.role:{$roles}"
])->group(function () {
  Route::prefix('pendonor')->name('donors.')->group(function () {
    Route::get('home', function () {
      return view('bases.home');
    })->name('home');
  });
});
