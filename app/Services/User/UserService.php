<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function query();
  public function getUserNotAdmin();
  public function getUserByRole(string $role);
  public function updateStatusAccount(int $id);
  public function handleCreateDonor(Request $request);
  public function handleCreateOfficer(Request $request);
  public function handleUpdateOfficer(Request $request, int $id);
  public function handleDeleteUser(int $id);
}
