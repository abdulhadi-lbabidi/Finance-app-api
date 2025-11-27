<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deposit;

class DepositSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $deposit = Deposit::factory()->create([
      'name' => ' أمانات المكتب',
      'desc' => 'المحافظة - جانب مغسلة المحافظة',
    ]);
  }
}