<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles_permission = [
            'super-admin' => [
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
            ],
            'admin' => [
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
            ],
            'editor' => ['user_view'],
            'user' => [],
        ];

        foreach ($roles_permission as $role_name => $permissions) {
            $role_id = DB::table('roles')->where('name', $role_name)->value('id');

            foreach ($permissions as $permission_name) {
                $permission_id = DB::table('permissions')->where('name', $permission_name)->value('id');

                if ($role_id && $permission_id) {
                    DB::table('roles_permissions')->insert([
                        'role_id' => $role_id,
                        'permission_id' => $permission_id,
                    ]);
                }
            }
        }
    }
}
