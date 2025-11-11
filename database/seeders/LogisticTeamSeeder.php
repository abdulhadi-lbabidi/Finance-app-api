<?php

namespace Database\Seeders;

use App\Models\LogisticTeam;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogisticTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $LT1 =LogisticTeam::factory()->create([
            'name'=> 'أحمد عيني',
            'desc'=> 'مراقب ورشة',
        ]);
        $LT1->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963966917471'
        ]);
        $LT2 =LogisticTeam::factory()->create([
            'name'=> 'أحمد موسى',
            'desc'=> 'مراقب ورشة',
        ]);
        $LT2->phones()->create([
            'name'=>'الهاتف',
            'number'=> '+963954282944'
        ]);

    }
}
