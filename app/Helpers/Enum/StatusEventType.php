<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum StatusEventType: string
{
  use EnumsToArray;

  case AVAILABLE = 'Tersedia';
  case UNAVAILABLE = 'Tidak Tersedia';
}
