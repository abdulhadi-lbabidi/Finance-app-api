<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $office = Office::factory()->create([
      'name' => 'مكتب رئيسي',
      'address' => 'المحافظة - جانب مغسلة المحافظة',
      'location' => 'ss2',
    ]);
    // $tresure = $office->tresures()->create([
    //   'name' => 'أساسي',
    //   'active' => true,
    // ]);
    // $tresure2 = $office->tresures()->create([
    //   'name' => 'مدفوعات موظفين',
    //   'active' => true,
    // ]);
    // $tresurefund = $tresure2->tresurefunds()->create([
    //   'name' => '2025',
    //   'desc' => 'رواتب موظفين سنة 2025',
    // ]);
  }
}
