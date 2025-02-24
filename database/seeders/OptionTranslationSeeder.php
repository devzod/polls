<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Option;
use App\Models\OptionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = Option::all();
        $locales = Language::all();
        foreach ($options as $option) {
            foreach ($locales as $locale) {
                OptionTranslation::factory()->create([
                    'option_id' => $option->id,
                    'locale' => $locale->code,
                ]);
            }
        }
    }
}
