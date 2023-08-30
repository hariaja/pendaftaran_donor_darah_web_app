<?php

namespace App\Services\Donor;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface DonorService extends BaseService
{
  public function query();
  public function handleUpdatePendonor(Request $request, int $id);
  public function handleDeletePendonor(int $id);
}
