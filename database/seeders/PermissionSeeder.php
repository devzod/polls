<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    protected array $permissions = [
        ["name" => "permissions.index", "guard_name" => "web",],
        ["name" => "permissions.store", "guard_name" => "web",],
        ["name" => "permissions.update", "guard_name" => "web",],
        ["name" => "permissions.delete", "guard_name" => "web",],

        ["name" => "roles.index", "guard_name" => "web",],
        ["name" => "roles.store", "guard_name" => "web",],
        ["name" => "roles.update", "guard_name" => "web",],
        ["name" => "roles.delete", "guard_name" => "web",],

        ["name" => "users.index", "guard_name" => "web",],
        ["name" => "users.store", "guard_name" => "web",],
        ["name" => "users.update", "guard_name" => "web",],
        ["name" => "users.delete", "guard_name" => "web",],

        ["name" => "languages.index", "guard_name" => "web",],
        ["name" => "languages.store", "guard_name" => "web",],
        ["name" => "languages.update", "guard_name" => "web",],
        ["name" => "languages.delete", "guard_name" => "web",],

        ["name" => "regions.index", "guard_name" => "web",],
        ["name" => "regions.store", "guard_name" => "web",],
        ["name" => "regions.update", "guard_name" => "web",],
        ["name" => "regions.delete", "guard_name" => "web",],

        ["name" => "pos.index", "guard_name" => "web",],
        ["name" => "pos.store", "guard_name" => "web",],
        ["name" => "pos.update", "guard_name" => "web",],
        ["name" => "pos.delete", "guard_name" => "web",],

        ["name" => "polls.index", "guard_name" => "web",],
        ["name" => "polls.store", "guard_name" => "web",],
        ["name" => "polls.update", "guard_name" => "web",],
        ["name" => "polls.delete", "guard_name" => "web",],

        ["name" => "stuffs.index", "guard_name" => "web",],
        ["name" => "stuffs.store", "guard_name" => "web",],
        ["name" => "stuffs.update", "guard_name" => "web",],
        ["name" => "stuffs.delete", "guard_name" => "web",],

        ["name" => "participants.index", "guard_name" => "web",],
        ["name" => "participants.store", "guard_name" => "web",],
        ["name" => "participants.update", "guard_name" => "web",],
        ["name" => "participants.delete", "guard_name" => "web",],

    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            if (!Permission::query()->where('name', $permission['name'])->exists()) {
                Permission::query()->create($permission);
            }
        }
    }
}
