<?php

namespace Database\Seeders;

use App\Models\InnerTransaction;
use App\Models\Invoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InnerTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 20; $i++) {
            $temp_inn = InnerTransaction::factory()->create();
            for ($j=0; $j < 30; $j++) {
                $temp_inn->invoices()->create([
                    'name'=>fake()->name(),
                    'desc'=>fake()->name(),
                    'amount'=>fake()->numberBetween(100,1000),
                    'finance_item_id'=>fake()->numberBetween(1,7),
                ]);
            }
        }
    }
}
