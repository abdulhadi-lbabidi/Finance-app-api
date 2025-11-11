<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emp1 =Employee::factory()->create([
            'name'=>'حاتم الصالح',
            'address'=>'حلب الجديدة شمالي',
            'employee_type_id'=>1,
            'department_id'=>1
        ]);
        $emp1->tresure()->create([
            'name'=>'أساسي',
            'active'=>true,
        ]);
        $emp1->user()->create([
            'email'=>'hatem.alsaleh@nouhagency.com',
            'password'=>bcrypt('1234.4321A'),
        ]);
        $emp1->phones()->create([
            'name'=>'الهاتف',
            'number'=>'+963935936396'
        ]);
        $emp2 =Employee::factory()->create([
            'name'=>'عبد الهادي لبابيدي',
            'address'=>'حلب الجديدة جنوبي',
            'employee_type_id'=>1,
            'department_id'=>3,
        ]);
        $emp2->tresure()->create([
            'name'=>'أساسي',
            'active'=>true,
        ]);
        $emp2->user()->create([
            'email'=>'abdalhadi.lbabidi@nouhagency.com',
            'password'=>bcrypt('1234.4321A'),
        ]);
        $emp2->phones()->create([
            'name'=>'الهاتف',
            'number'=>'+963957464304'
        ]);
        $emp3 =Employee::factory()->create([
            'name'=>'احمد شحرور',
            'address'=>'حلب الجديدة شمالي',
            'employee_type_id'=>3,
            'department_id'=>2
        ]);
        $emp3->tresure()->create([
            'name'=>'أساسي',
            'active'=>true,
        ]);
        $emp3->user()->create([
            'email'=>'ahmad.shahrour@nouhagency.com',
            'password'=>bcrypt('1234.4321A'),
        ]);
        $emp3->phones()->create([
            'name'=>'الهاتف',
            'number'=>'+963932893379'
        ]);
        $emp4 = Employee::factory()->create([
            'name'=>'رامي علايا',
            'address'=>'سيف الدولة مفرق  المول الملكي',
            'employee_type_id'=>3,
            'department_id'=>2
        ]);
        $emp4->tresure()->create([
            'name'=>'أساسي',
            'active'=>true,
        ]);
        $emp4->user()->create([
            'email'=>'rami.alaya@nouhagency.com',
            'password'=>bcrypt('1234.4321A'),
        ]);
        $emp4->phones()->create([
            'name'=>'الهاتف',
            'number'=>'+963945491161'
        ]);

    }
}
