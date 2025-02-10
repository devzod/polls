<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    protected array $roles = [
        ["name" => "superadmin", 'guard_name' => "web"],
        ["name" => "admin", 'guard_name' => "web"],
        ["name" => "user", 'guard_name' => "web"],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->roles as $role) {
            $newRole = Role::query()->where('name', $role['name'])->first();
            if (!$newRole) {
                $newRole = Role::query()->create($role);
            }
            $newRole->syncPermissions(Permission::all());
        }
    }
}
