<?php

namespace Database\Factories;

use App\Models\TresureFund;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OuterTransaction>
 */
class OuterTransactionFactory extends Factory
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
            'payed'=>fake()->boolean(),
            'amount'=>fake()->numberBetween(100,1000),
            'tresure_fund_id'=>TresureFund::all()->random()->id,
            'indate'=>fake()->date(new Carbon(today())),

        ];
    }
}
