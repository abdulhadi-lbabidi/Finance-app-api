<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $admin = Admin::factory()->create([
      'name' => 'عبد الرحمن نوح',
      'address' => 'حلب - حلب الجديدة شمالي',
      'admin_level' => 'مالك',
      'department' => 'هندسة معمارية',
      'admintype_id' => 1
    ]);
    // $tresure = $admin->tresures()->create([
    //     'name'=>'أساسي',
    //     'active'=>true,
    // ]);
    // $tresurefund = $tresure->tresurefunds()->create([
    //     'name'=>'أساسي',
    //     'desc'=>fake()->text(),
    // ]);
    $user = $admin->user()->create([
      'email' => 'abdalrahman.nouh@nouhagency.com',
      'password' => bcrypt('1234.4321A'),
    ]);
    $phone = $admin->phones()->create([
      'name' => 'الهاتف',
      'number' => '+963946963546',
    ]);
    $socialmedia = $admin->socialmedias()->create([
      'url' => 'https://www.google.com/',
      'socialmediatype_id' => 1
    ]);
    $socialmedia = $admin->socialmedias()->create([
      'url' => 'https://www.google.com/',
      'socialmediatype_id' => 2
    ]);
    $socialmedia = $admin->socialmedias()->create([
      'url' => 'https://www.google.com/',
      'socialmediatype_id' => 3
    ]);
  }
}