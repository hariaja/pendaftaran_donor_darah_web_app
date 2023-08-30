<?php

use App\Helpers\Enum\RoleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\DonorController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\PasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Auth::routes(['verify' => true]);

$roles = implode(',', [RoleType::ADMIN->value, RoleType::OFFICER->value]);

Route::middleware([
  'auth',
  'permission',
  'verified',
  "check.role:{$roles}"
])->group(function () {
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::prefix('settings')->group(function () {
    // Role management.
    Route::resource('roles', RoleController::class)->except('show');

    // User management.
    Route::patch('users/status/{user}', [UserController::class, 'status'])->name('users.status');
    Route::resource('users', UserController::class)->except('edit');

    // Donor Management.
    Route::resource('donors', DonorController::class)->names('donations')->except(
      'edit',
      'create',
      'store',
    );
  });

  // Management password users.
  Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('users.password');
  Route::post('users/password', [PasswordController::class, 'store']);
});

require __DIR__ . '/donor.php';
