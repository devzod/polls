<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
      protected array $languages = [
        ['name' => 'Русский', 'code' => 'ru', 'icon' => 'flags/ru.png'],
        ['name' => "O'zbek", 'code' => 'uz', 'icon' => 'flags/uz.png'],
//        ['name' => 'English', 'code' => 'en', 'icon' => 'flags/en.png'],
      ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->languages as $language) {
            Language::query()->updateOrInsert(['code'=> $language['code']], $language);
        }
    }
}
