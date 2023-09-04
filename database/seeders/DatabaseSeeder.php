<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      PermissionCategorySeeder::class,
      PermissionSeeder::class,
      RoleSeeder::class,
      BloodTypeSeeder::class,
      AdminSeeder::class,
      OfficerSeeder::class,
      DonorSeeder::class,
      EventSeeder::class,
    ]);
  }
}
