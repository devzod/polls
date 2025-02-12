<?php

namespace Database\Seeders;

use App\Models\Pos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pos::factory()->count(50)->create();
    }
}
