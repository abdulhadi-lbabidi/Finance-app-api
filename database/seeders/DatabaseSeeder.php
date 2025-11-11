<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\LogisticTeam;
use App\Models\TechnicalTeam;
use App\Models\User;
use App\Models\Workshop;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        DepartmentSeeder::class],);
        $this->call([
        SocialMediaTypeSeeder::class],);
        $this->call([
        AdminTypeSeeder::class],);
        $this->call([
        AdminSeeder::class],);
        $this->call([
        CustomerSeeder::class],);
        $this->call([
        WorkshopSeeder::class],);
        $this->call([
        EmployeeTypeSeeder::class],);
        $this->call([
        EmployeeSeeder::class],);
        $this->call([
        TechnicalTeamSeeder::class],);
        $this->call([
        LogisticTeamSeeder::class],);
        $this->call([
        FinanceItemSeeder::class],);
        $this->call([
        TresureFundSeeder::class],);
        $this->call([
        InnerTransactionSeeder::class],);
        $this->call([
        OuterTransactionSeeder::class],);
        $this->call([
        InvoiceItemSeeder::class],);
        $this->call([
        LogiPaySeeder::class],);
        $this->call([
        EmployeePaySeeder::class],);
        $this->call([
        TechPaySeeder::class],);
        $this->call([
        MoneyTranfareSeeder::class],);
        $this->call([
        NoteSeeder::class],);
        $this->call([
        OfficeSeeder::class],);
        for ($i=0; $i < 10; $i++) {
            Inventory::factory()->create([
                'name'=> 'مادة',
                'quantity'=>fake()->numberBetween(1,10),
                'statue'=> fake()->boolean(),
                'type'=>fake()->randomElement(['سحب','اعطاء']),
                'invetorable_type'=>'LogisticTeam',
                'invetorable_id'=>LogisticTeam::all()->random()->id,
                'fromdate'=>new Carbon(today()),
            ]);
            Inventory::factory()->create([
                'name'=> 'مادة',
                'quantity'=>fake()->numberBetween(1,10),
                'statue'=> fake()->boolean(),
                'type'=>fake()->randomElement(['سحب','اعطاء']),
                'invetorable_type'=>'TechnicalTeam',
                'invetorable_id'=>TechnicalTeam::all()->random()->id,
                'fromdate'=>new Carbon(today()),
            ]);
            Inventory::factory()->create([
                'name'=> 'مادة',
                'quantity'=>fake()->numberBetween(1,10),
                'statue'=> fake()->boolean(),
                'type'=>fake()->randomElement(['سحب','اعطاء']),
                'invetorable_type'=>'employee',
                'invetorable_id'=>Employee::all()->random()->id,
                'fromdate'=>new Carbon(today()),
            ]);
            Inventory::factory()->create([
                'name'=> 'مادة',
                'quantity'=>fake()->numberBetween(1,10),
                'statue'=> fake()->boolean(),
                'type'=>fake()->randomElement(['سحب','اعطاء']),
                'invetorable_type'=>'customer',
                'invetorable_id'=>Customer::all()->random()->id,
                'fromdate'=>new Carbon(today()),
            ]);
            Inventory::factory()->create([
                'name'=> 'مادة',
                'quantity'=>fake()->numberBetween(1,10),
                'statue'=> fake()->boolean(),
                'type'=>fake()->randomElement(['سحب','اعطاء']),
                'invetorable_type'=>'workshop',
                'invetorable_id'=>Workshop::all()->random()->id,
                'fromdate'=>new Carbon(today()),
            ]);
        }
    }
}
