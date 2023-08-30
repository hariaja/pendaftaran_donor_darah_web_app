<?php

namespace App\Services\Donor;

use App\Helpers\Global\Helper;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\Donor\DonorRepository;

class DonorServiceImplement extends Service implements DonorService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $userRepository,
    protected RoleRepository $roleRepository,
    protected DonorRepository $mainRepository,
  ) {
    // 
  }

  /**
   * Get base query service.
   *
   * @return void
   */
  public function query()
  {
    return DB::transaction(function () {
      return $this->mainRepository->query();
    });
  }

  public function handleUpdatePendonor($request, $id)
  {
    return DB::transaction(function () use ($request, $id) {
      // Find Donor Data
      $donor = $this->mainRepository->findOrFail($id);

      // Find User Data
      $user = $this->userRepository->findOrFail($donor->user_id);

      // Handle Upload File Avatar
      // Define prefix folder
      $path = $this->getRoleName($user->getRoleId());
      $avatar = Helper::uploadFile($request, "images/{$path}", $user->avatar);

      // Define Age Donor
      $age = Helper::convertToAge($request->dob);

      // Update User & Donor Data
      $validation = $request->validated();
      $validation['avatar'] = $avatar;

      $user->update($validation);
      $user->assignRole($user->getRoleName());

      // Update Donor Data
      $updated = [
        'nik' => $validation['nik'],
        'blood_type_id' => $validation['blood_type_id'],
        'rhesus' => $request['rhesus'],
        'gender' => $validation['gender'],
        'dob' => $validation['dob'],
        'age' => $age,
        'job_title' => $validation['job_title'],
        'address' => $validation['address'],
      ];

      return $this->mainRepository->update($id, $updated);
    });
  }

  public function handleDeletePendonor($id)
  {
    return DB::transaction(function () use ($id) {
      // Find Donor Data
      $donor = $this->mainRepository->findOrFail($id);

      // Find User Data
      $user = $this->userRepository->findOrFail($donor->user_id);

      // Delete File Avatar
      if ($user->avatar) {
        Storage::delete($user->avatar);
      }

      return $this->userRepository->delete($user->id);
    });
  }

  /**
   * Private func for get role name
   */
  protected function getRoleName(int $id): string
  {
    $role = $this->roleRepository->findOrFail($id);
    return "{$role->name}";
  }
}
