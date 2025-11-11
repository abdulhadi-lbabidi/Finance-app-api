<?php

namespace Database\Factories;

use App\Models\EmployeePay;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeReward>
 */
class EmployeeRewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'desc'=>fake()->name(),
            'amount'=>fake()->numberBetween(10,150),
            'emppay_id'=>EmployeePay::all()->random()->id,
        ];
    }
}
