<?php

namespace Database\Seeders;

use App\Models\AdminType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminType::factory()->create([
            'name'=> 'مدير'
        ]);
        AdminType::factory()->create([
            'name'=> 'مستثمر'
        ]);
        AdminType::factory()->create([
            'name'=> 'شريك'
        ]);
        AdminType::factory()->create([
            'name'=> 'شريك نسبة'
        ]);
    }
}
