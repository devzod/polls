<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\RegionTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    protected $regions_uz = [
        "Qoraqalpog‘iston Respublikasi",
        "Andijon viloyati",
        "Buxoro viloyati",
        "Jizzax viloyati",
        "Qashqadaryo viloyati",
        "Navoiy viloyati",
        "Namangan viloyati",
        "Samarqand viloyati",
        "Surxandaryo viloyati",
        "Sirdaryo viloyati",
        "Toshkent viloyati",
        "Farg‘ona viloyati",
        "Xorazm viloyati",
        "Toshkent shahri",
    ];

    protected $regions_ru = [
        "Республика Каракалпакстан",
        "Андижанская область",
        "Бухарская область",
        "Джизакская область",
        "Кашкадарьинская область",
        "Навоийская область",
        "Наманганская область",
        "Самаркандская область",
        "Сурхандарьинская область",
        "Сырдарьинская область",
        "Ташкентская область",
        "Ферганская область",
        "Хорезмская область",
        "Город Ташкент",
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 14; $i++) {
            $region = Region::query()->create(['status' => true]);
            RegionTranslation::query()->create([
                'region_id' => $region->id,
                'locale' => 'uz',
                'name' => $this->regions_uz[$i - 1],
            ]);
            RegionTranslation::query()->create([
                'region_id' => $region->id,
                'locale' => 'ru',
                'name' => $this->regions_ru[$i - 1],
            ]);
        }
    }
}
