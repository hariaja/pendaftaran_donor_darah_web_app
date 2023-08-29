<?php

namespace Database\Seeders;

use App\Models\User;
use App\Helpers\Enum\RoleType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficerSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    for ($i = 1; $i <= 5; $i++) :
      $oficers = User::factory()->create();
      $oficers->assignRole(RoleType::OFFICER->value);
    endfor;
  }
}
