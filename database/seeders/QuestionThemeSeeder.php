<?php

namespace Database\Seeders;

use App\Models\QuestionTheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuestionTheme::factory()->count(5)->create();
    }
}
