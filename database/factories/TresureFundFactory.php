<?php

namespace Database\Factories;

use App\Models\Tresure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TresureFund>
 */
class TresureFundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name,
            'desc'=>fake()->text,
            'tresure_id'=>Tresure::all()->random()->id,
        ];
    }
}
