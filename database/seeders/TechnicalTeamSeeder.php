<?php

namespace Database\Seeders;

use App\Models\TechnicalTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnicalTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TT1 = TechnicalTeam::factory()->create([
            'name'=> 'حكمت غطاس',
            'desc'=> 'اختصاص تمديدات صحية',
            'spec' => 'صحية',
        ]);
        $TT1->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963936257030'
        ]);
        $TT2 =TechnicalTeam::factory()->create([
            'name'=> 'محمد جبسة',
            'desc'=> 'اختصاص تمديدات كهربائية وتركيب',
            'spec' => 'كهرباء',
        ]);
        $TT2->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963956958852'
        ]);
        $TT3 = TechnicalTeam::factory()->create([
            'name'=> 'براق غطاس',
            'desc'=> 'اختصاص تمديدات تكييف وتركيب',
            'spec' => 'تكييف',
        ]);
        $TT3->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963994444861'
        ]);
        $TT4 = TechnicalTeam::factory()->create([
            'name'=> 'علي حمشو',
            'desc'=> 'اختصاص تمديدات كهربائية وتركيب',
            'spec' => 'كهرباء',
        ]);
        $TT4->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963959480306'
        ]);
        $TT5 = TechnicalTeam::factory()->create([
            'name'=> 'علي جواد',
            'desc'=> 'اختصاص تمديد وتركيب ألمنيوم',
            'spec' => 'ألمنيوم',
        ]);
        $TT5->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963946111557'
        ]);


    }
}
