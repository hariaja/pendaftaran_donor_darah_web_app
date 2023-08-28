<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum RoleType: string
{
  use EnumsToArray;

  case ADMIN = 'Administrator';
  case OFFICER = 'Petugas';
  case DONOR = 'Pendonor';
}
