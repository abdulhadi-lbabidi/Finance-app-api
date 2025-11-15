<?php

namespace Database\Seeders;

use App\Models\OuterTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OuterTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $temp_out = OuterTransaction::factory()->create();
            for ($j = 0; $j < 10; $j++) {
                $temp_out->invoices()->create([
                    'name' => fake()->name(),
                    'desc' => fake()->name(),
                    'amount' => fake()->numberBetween(100, 1000),
                    'finance_item_id' => fake()->numberBetween(1, 5),
                ]);
            }
        }
    }
}
