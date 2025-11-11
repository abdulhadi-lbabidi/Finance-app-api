<?php

namespace Database\Seeders;

use App\Models\LogiPay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogiPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogiPay::factory()->count(50)->create();
    }
}
