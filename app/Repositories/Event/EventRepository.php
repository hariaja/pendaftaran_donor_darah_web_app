<?php

namespace App\Repositories\Event;

use LaravelEasyRepository\Repository;

interface EventRepository extends Repository
{
  public function query();
}
