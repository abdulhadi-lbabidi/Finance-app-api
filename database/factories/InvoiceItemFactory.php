<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
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
            'invoice_id'=> Invoice::all()->random()->id
        ];
    }
}
