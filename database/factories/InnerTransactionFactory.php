<?php

namespace Database\Factories;

use App\Models\TresureFund;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InnerTransaction>
 */
class InnerTransactionFactory extends Factory
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
            'payed'=>fake()->boolean,
            'amount'=>fake()->numberBetween(100,1000),
            'tresure_fund_id'=>TresureFund::all()->random()->id,
            'indate'=>fake()->date(new Carbon(today())),
        ];
    }
}
