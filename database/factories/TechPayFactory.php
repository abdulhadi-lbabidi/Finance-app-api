<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\TechnicalTeam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TechPay>
 */
class TechPayFactory extends Factory
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
            'desc'=>fake()->text(),
            'amount'=>$amount,
            'price'=>$price,
            'finalprice'=>$amount * $price,
            'workshopname'=>'',
            'payed'=>fake()->boolean(),
            'technical_team_id'=>TechnicalTeam::all()->random()->id,
            'invoice_id'=>Invoice::all()->random()->id,
        ];
    }
}
