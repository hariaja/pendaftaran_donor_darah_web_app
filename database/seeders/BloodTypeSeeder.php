<?php

namespace Database\Seeders;

use App\Models\BloodType;
use App\Helpers\Enum\BloodType as Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $items = Type::toArray();

    foreach ($items as $type) :
      BloodType::firstOrCreate([
        'type' => $type,
      ]);
    endforeach;
  }
}
