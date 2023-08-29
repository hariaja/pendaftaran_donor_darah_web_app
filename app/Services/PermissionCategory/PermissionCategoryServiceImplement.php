<?php

namespace App\Services\PermissionCategory;

use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Repositories\PermissionCategory\PermissionCategoryRepository;

class PermissionCategoryServiceImplement extends Service implements PermissionCategoryService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(PermissionCategoryRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function query()
  {
    return DB::transaction(function () {
      return $this->mainRepository->query();
    });
  }

  public function with(array $with = [])
  {
    return DB::transaction(function () use ($with) {
      return $this->mainRepository->with($with);
    });
  }
}
