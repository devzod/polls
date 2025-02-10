<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'name' => "Super Admin",
            'username' => "superadmin",
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt("superadmin")
        ];
        $newUser = User::query()->where('name', $user['username'])->first();
        if (!$newUser){
            $newUser = User::query()->create($user);
        }
        $newUser->syncRoles(Role::all());
    }
}
