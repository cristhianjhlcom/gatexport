<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user_view',
            'user_create',
            'user_edit',
            'user_delete',
            'user_assign-role',
            'role_view',
            'role_create',
            'role_edit',
            'role_delete',
            'permission_view',
            'permission_assign',
            'permission_manage',
        ];

        foreach ($permissions as $permission) {
            Permission::factory()->create([
                'name' => $permission,
            ]);
        }
    }
}
