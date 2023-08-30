<?php

namespace App\Services\Donor;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Repositories\Donor\DonorRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Storage;

class DonorServiceImplement extends Service implements DonorService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $userRepository,
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
}
