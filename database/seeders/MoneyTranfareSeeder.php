<?php

namespace Database\Seeders;

use App\Models\MoneyTranfare;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoneyTranfareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MoneyTranfare::factory()->count(100)->create();
    }
}
