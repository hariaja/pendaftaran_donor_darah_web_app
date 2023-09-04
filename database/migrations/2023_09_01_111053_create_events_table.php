<?php

use App\Helpers\Enum\StatusEventType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('events', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->string('name', 100)->nullable();
      $table->string('latitude')->nullable();
      $table->string('longitude')->nullable();
      $table->string('organizer')->nullable();
      $table->string('address', 100)->nullable();
      $table->enum('status', StatusEventType::toArray())->default(StatusEventType::UNAVAILABLE->value);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('events');
  }
};
