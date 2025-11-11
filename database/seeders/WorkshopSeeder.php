<?php

namespace Database\Seeders;

use App\Models\Workshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Workshop::factory()->create([
            'name'=>'W64',
            'location'=>fake()->address(),
            'customer_id'=>1,
        ])->tresures()->create([
            'name'=>'أساسي',
            'active'=>true,
        ]);
    }
}
