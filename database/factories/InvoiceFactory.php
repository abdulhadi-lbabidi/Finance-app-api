<?php

namespace Database\Factories;

use App\Models\FinanceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'amount'=>fake()->numberBetween(10,100),
            'finance_item_id'=>FinanceItem::all()->random()->id
        ];
    }
}
