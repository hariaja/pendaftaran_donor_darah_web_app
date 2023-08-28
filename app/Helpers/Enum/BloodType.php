<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum BloodType: string
{
  use EnumsToArray;

  case A = 'A';
  case B = 'B';
  case AB = 'AB';
  case O = 'O';
  case UNKNOWN = 'Tidak Tahu';
}
