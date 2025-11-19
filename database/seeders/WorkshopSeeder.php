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
        $workshop = Workshop::factory()->create([
            'name'=>'W64',
            'location'=>fake()->address(),
            'customer_id'=>1,
        ]);
        $tresure = $workshop->tresures()->create([
            'name'=>'أساسي',
            'active'=>true,
        ]);

        $tresure->tresurefunds()->create([
            'name'=>'أساسي',
            'desc'=>fake()->text(),
        ]);

    }
}
