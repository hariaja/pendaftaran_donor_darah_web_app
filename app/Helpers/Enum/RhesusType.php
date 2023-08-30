<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum RhesusType: string
{
  use EnumsToArray;

  case POSITIVE = 'Positif (+)';
  case NEGATIVE = 'Negatif (-)';
  case UNKNOWN = 'Tidak Tahu';
}
