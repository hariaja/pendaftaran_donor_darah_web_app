<?php

namespace App\Services\User;

use App\Helpers\Global\Helper;
use App\Repositories\Role\RoleRepository;
use LaravelEasyRepository\Service;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

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
   * Private func for get role name
   */
  protected function getRoleName(int $id): string
  {
    $role = $this->roleRepository->findOrFail($id);
    return "{$role->name}";
  }
}
