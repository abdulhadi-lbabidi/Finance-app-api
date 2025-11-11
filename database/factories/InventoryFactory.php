<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\LogisticTeam;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> 'مادة',
            'quantity'=>fake()->numberBetween(1,10),
            'statue'=> fake()->boolean(),
            'type'=>fake()->randomElement(['سحب','اعطاء']),
            'fromdate'=>fake()->date(new Carbon(today())),
        ];
    }
}
