<?php

namespace App\Services\Event;

use LaravelEasyRepository\Service;
use App\Repositories\Event\EventRepository;
use Illuminate\Support\Facades\DB;

class EventServiceImplement extends Service implements EventService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  public function __construct(
    protected EventRepository $mainRepository
  ) {
    // 
  }

  /**
   * Base Query
   */
  public function query()
  {
    return DB::transaction(fn () => $this->mainRepository->query());
  }
}
