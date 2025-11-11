<?php

namespace Database\Seeders;

use App\Models\SocialMediaType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SocialMediaType::factory()->create([
            'name'=>'Facebook'
        ]);
        SocialMediaType::factory()->create([
            'name'=>'Instagram'
        ]);
        SocialMediaType::factory()->create([
            'name'=>'What\'s app'
        ]);
        SocialMediaType::factory()->create([
            'name'=>'Linked In'
        ]);
        SocialMediaType::factory()->create([
            'name'=>'Behance'
        ]);
        SocialMediaType::factory()->create([
            'name'=>'Threads'
        ]);
        SocialMediaType::factory()->create([
            'name'=>'Telegram'
        ]);
    }
}
