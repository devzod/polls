<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Question;
use App\Models\QuestionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();
        $locales = Language::all();
        foreach ($questions as $question) {
            foreach ($locales as $locale) {
                QuestionTranslation::factory()->create([
                    'question_id' => $question->id,
                    'locale' => $locale->code,
                ]);
            }
        }
    }
}
