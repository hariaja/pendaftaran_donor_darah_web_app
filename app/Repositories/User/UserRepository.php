<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
  public function query();
  public function getUserNotAdmin();
  public function getUserByRole(string $role);
  public function updateStatusAccount(int $id);
}
