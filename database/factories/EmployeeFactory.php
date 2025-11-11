<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\EmployeeType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'address'=>fake()->address,
            'employee_type_id'=>EmployeeType::all()->random()->id,
            'department_id'=>Department::all()->random()->id
        ];
    }
}
