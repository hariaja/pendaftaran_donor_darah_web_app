<?php

namespace Database\Seeders;

use App\Helpers\Enum\StatusEventType;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $events = [
      [
        'name' => 'Donor Darah',
        'organizer' => 'PMI Sukabumi',
        'latitude' => '-6.921240',
        'longitude' => '106.915800',
        'address' => '3WH9+MPG, Benteng, Kec. Warudoyong, Kota Sukabumi, Jawa Barat 43132',
        'status' => StatusEventType::AVAILABLE->value,
      ],
    ];

    foreach ($events as $event) {
      Event::create($event);
    }
  }
}
