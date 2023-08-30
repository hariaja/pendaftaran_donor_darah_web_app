<?php

namespace App\Repositories\BloodType;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\BloodType;

class BloodTypeRepositoryImplement extends Eloquent implements BloodTypeRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(BloodType $model)
  {
    $this->model = $model;
  }

  public function query()
  {
    return $this->model->query();
  }
}
