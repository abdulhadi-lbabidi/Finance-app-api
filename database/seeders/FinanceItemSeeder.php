<?php

namespace Database\Seeders;

use App\Models\FinanceItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinanceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FinanceItem::factory()->create([
            'name'=>'صحية'
        ]);
        FinanceItem::factory()->create([
            'name'=>'كهربائية'
        ]);
        FinanceItem::factory()->create([
            'name'=>'المنيوم'
        ]);
        FinanceItem::factory()->create([
            'name'=>'بناء'
        ]);
        FinanceItem::factory()->create([
            'name'=>'مفروشات'
        ]);
        FinanceItem::factory()->create([
            'name'=>'تكييف'
        ]);
        FinanceItem::factory()->create([
            'name'=>'خشب'
        ]);
    }
}
