<?php

namespace App\Repositories\Event;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Event;

class EventRepositoryImplement extends Eloquent implements EventRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  public function __construct(
    protected Event $model
  ) {
    // 
  }

  public function query()
  {
    return $this->model->query();
  }
}
