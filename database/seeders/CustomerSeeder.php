<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = Customer::factory()->create([
            'name'=>'عمار كركر',
            'address'=>'حلب-حلب الجديدة حنوبي جامع الرحمة',
        ]);

        $customer->user()->create([
            'email'=>'ammar.krkr@nouhagency.com',
            'password'=>bcrypt('1234.4321A'),
        ]);
        $customer->phones()->create([
            'name'=>'الهاتف',
            'number'=>'+963955555555',
        ]);
    }
}
