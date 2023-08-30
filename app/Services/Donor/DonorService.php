<?php

namespace App\Services\Donor;

use LaravelEasyRepository\BaseService;

interface DonorService extends BaseService
{
  public function query();
  public function handleDeletePendonor(int $id);
}
