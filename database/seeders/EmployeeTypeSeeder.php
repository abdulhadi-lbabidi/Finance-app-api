<?php

namespace Database\Seeders;

use App\Models\EmployeeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeType::factory()->create([
            'name'=> 'رئيس قسم'
        ]);
        EmployeeType::factory()->create([
            'name'=> 'مدير قسم'
        ]);
        EmployeeType::factory()->create([
            'name'=> 'موظف'
        ]);
        EmployeeType::factory()->create([
            'name'=> 'مدير مشروع'
        ]);
        EmployeeType::factory()->create([
            'name'=> 'مدير مشاريع'
        ]);
    }
}
