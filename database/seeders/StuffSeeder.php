<?php

namespace Database\Seeders;

use App\Models\Stuff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StuffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stuff::query()->create([
            "name" => "Test Stuff",
            "phone" => "999999999",
            "login" => "stuff",
            "password" => Hash::make('password'),
        ]);
        Stuff::factory()->count(20)->create();
    }
}
