<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\LogisticTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogiPay>
 */
class LogiPayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->numberBetween(1,10);
        $price = fake()->numberBetween(1,2);
        return [
            'name'=>fake()->name,
            'desc'=>fake()->text,
            'amount'=>$amount,
            'price'=>$price,
            'finalprice'=>$amount * $price,
            'workshopname'=>'',
            'payed'=>fake()->boolean(),
            'logistic_team_id'=>LogisticTeam::all()->random()->id,
            'invoice_id'=>Invoice::all()->random()->id,


        ];
    }
}
