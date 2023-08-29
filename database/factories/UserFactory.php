<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Helpers\Enum\StatusActiveType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // Create email like name user
    $fullName = fake()->firstName() . ' ' . fake()->lastName();

    $nameParts = explode(" ", $fullName);
    $firstNameInitial = strtolower(substr($nameParts[0], 0, 1));
    $lastNameWithoutSpaces = strtolower(str_replace(' ', '', $nameParts[1]));

    $email = "{$lastNameWithoutSpaces}@gmail.com";

    $phonePrefix = '62'; // Prefix kode negara Indonesia
    $phoneNumber = fake()->unique()->numerify($phonePrefix . '###########');

    $factories = [
      'name' => $fullName,
      'email' => $email,
      'phone' => $phoneNumber,
      'email_verified_at' => now(),
      'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
      'remember_token' => Str::random(10),
      'status' => StatusActiveType::ACTIVE->value,
    ];

    return $factories;
  }

  /**
   * Indicate that the model's email address should be unverified.
   */
  public function unverified(): static
  {
    return $this->state(fn (array $attributes) => [
      'email_verified_at' => null,
    ]);
  }
}
