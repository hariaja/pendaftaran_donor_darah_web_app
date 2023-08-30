<?php

namespace App\Services\User;

use App\Helpers\Global\Helper;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Enum\StatusActiveType;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Role\RoleRepository;
use App\Repositories\User\UserRepository;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */

  public function __construct(
    protected UserRepository $mainRepository,
    protected RoleRepository $roleRepository
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

  /**
   * Get all users, except where role name Administrator.
   *
   * @return void
   */
  public function getUserNotAdmin()
  {
    return DB::transaction(function () {
      return $this->mainRepository->getUserNotAdmin();
    });
  }

  /**
   * Handle create new officer and store to database.
   *
   * @param  mixed $request
   * @return void
   */
  public function handleCreateOfficer($request)
  {
    return DB::transaction(function () use ($request) {
      // Get role to find or get id role
      $role = $this->roleRepository->selectRoleWhereIn([$request->roles])->first();

      // Prefix folder to save images
      $path = strtolower($this->getRoleName($role->id));

      /**
       * Jika ada avatar yang diupload maka akan digunakan sebagai avatar user
       * Jika tidak ada, maka avatar secara otomatis bernilai null
       */
      $avatar = Helper::uploadFile($request, "images/{$path}", null);

      # Save data into database
      $validation = $request->validated();
      $validation['avatar'] = $avatar;
      $validation['password'] = Hash::make(Helper::DEFAULT_PASSWORD);
      $validation['status'] = StatusActiveType::ACTIVE->value;

      # Sync user to role
      $user = $this->mainRepository->create($validation);
      $user->assignRole($request->roles);
    });
  }

  /**
   * Handle update user where role Admin & Officer.
   *
   * @param  mixed $request
   * @param  mixed $id
   * @return void
   */
  public function handleUpdateOfficer($request, $id)
  {
    return DB::transaction(function () use ($request, $id) {
      // Find User By Id
      $user = $this->mainRepository->findOrFail($id);

      // Folder Prefix
      $path = strtolower($this->getRoleName($user->getRoleId()));

      // Handle Upload Avatar
      $avatar = Helper::uploadFile($request, "images/{$path}", $user->avatar);

      // Handle update users
      $validation = $request->validated();
      $validation['avatar'] = $avatar;

      return $this->mainRepository->update($user->id, $validation);
    });
  }

  /**
   * Update Status Account User
   *
   * @param  mixed $id
   * @return void
   */
  public function updateStatusAccount($id)
  {
    return DB::transaction(function () use ($id) {
      return $this->mainRepository->updateStatusAccount($id);
    });
  }

  /**
   * Delete any user in database
   *
   * @param  mixed $id
   * @return void
   */
  public function handleDeleteUser(int $id)
  {
    return DB::transaction(function () use ($id) {
      $user = $this->mainRepository->findOrFail($id);
      if ($user->avatar) {
        Storage::delete($user->avatar);
      }

      return $this->mainRepository->delete($user->id);
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
