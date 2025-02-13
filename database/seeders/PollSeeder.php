<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Poll;
use App\Models\PollTranslation;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 20;
        for ($i = 1; $i <= $count; $i++) {
            Poll::query()->create();
        }
        $translations = [];
        for ($i = 1; $i <= $count; $i++) {
            Language::query()->each(function ($language) use ($i, &$translations) {
                $translations[] = [
                    'poll_id' => $i,
                    'title' => Factory::create()->text(100),
                    'text' => Factory::create()->paragraph,
                    'locale' => $language->code,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });
        }
        PollTranslation::query()->insert($translations);
    }
}
