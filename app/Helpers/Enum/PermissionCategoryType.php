<?php

namespace App\Helpers\Enum;

use App\Traits\EnumsToArray;

enum PermissionCategoryType: string
{
  use EnumsToArray;

  case USERS = 'users.name';
  case ROLES = 'roles.name';
  case DONATIONS = 'donations.name';
  case EVENTS = 'events.name';
}
