<?php

namespace App\Services\User;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface UserService extends BaseService
{
  public function query();
  public function handleUpdateOfficer(Request $request, int $id);
}
