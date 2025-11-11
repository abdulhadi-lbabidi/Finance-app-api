<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->create([
            'name'=> 'القسم المحاسبي'
        ]);
        Department::factory()->create([
            'name'=> 'القسم المعماري'
        ]);
        Department::factory()->create([
            'name'=> 'القسم التقني'
        ]);
        Department::factory()->create([
            'name'=> 'القسم التصميمي'
        ]);
    }
}
