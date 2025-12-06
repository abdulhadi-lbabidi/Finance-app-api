<?php

namespace Database\Factories;

use App\Models\AdminType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'name' => fake()->name,
      'address' => fake()->address,
      'admin_level' => fake()->name,
      'department' => fake()->name,
      'admintype_id' => AdminType::all()->random()->id
    ];
  }
}
