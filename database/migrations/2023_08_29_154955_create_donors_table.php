<?php

use App\Helpers\Enum\GenderType;
use App\Helpers\Enum\RhesusType;
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
    Schema::create('donors', function (Blueprint $table) {
      $table->id();
      $table->string('uuid');
      $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
      $table->foreignId('blood_type_id')->constrained('blood_types', 'id')->onDelete('cascade');
      $table->string('nik')->unique();
      $table->enum('gender', GenderType::toArray());
      $table->enum('rhesus', RhesusType::toArray())->nullable();
      $table->date('dob');
      $table->integer('age');
      $table->string('job_title');
      $table->text('address');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('donors');
  }
};
