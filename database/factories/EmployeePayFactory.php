<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Invoice;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeePay>
 */
class EmployeePayFactory extends Factory
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
            'payed'=>fake()->boolean(),
            'invoice_id'=>Invoice::all()->random()->id,
            'employee_id'=>Employee::all()->random()->id,
        ];
    }
}
