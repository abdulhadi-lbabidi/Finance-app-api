<?php

namespace Database\Factories;

use App\Models\TresureFund;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MoneyTranfare>
 */
class MoneyTranfareFactory extends Factory
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
            'desc'=>fake()->text(),
            'amount'=>fake()->numberBetween(100,1000),
            'from_tresure_fund_id'=>TresureFund::all()->random()->id,
            'to_tresure_fund_id'=>TresureFund::all()->random()->id,
        ];
    }
}
