<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Helpers\Enum\StatusActiveType;
use LaravelEasyRepository\Implementations\Eloquent;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  /**
   * Base query in model.
   */
  public function query()
  {
    return $this->model->query();
  }

  /**
   * Get All User Where Role Not Admin
   */
  public function getUserNotAdmin()
  {
    return $this->query()->select('*')->whereNotAdmin();
  }

  /**
   * Get all user group by roles.
   */
  public function getUserByRole($role)
  {
    return $this->query()->select('*')->whereHas('roles', function ($row) use ($role) {
      $row->where('name', $role);
    })->active();
  }

  /**
   * Update Status Account User
   */
  public function updateStatusAccount($id)
  {
    $user = $this->findOrFail($id);
    $newStatus = ($user->status == StatusActiveType::ACTIVE->value) ? StatusActiveType::INACTIVE->value : StatusActiveType::ACTIVE->value;
    $user->updateOrFail([
      'status' => $newStatus,
    ]);

    return $user;
  }
}
