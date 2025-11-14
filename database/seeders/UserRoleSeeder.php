<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $super_admin_user = User::factory()->create([
            'email' => 'admin@email.com',
            'password' => '12345678',
        ]);
        $super_admin_role = DB::table('roles')->where('name', 'super-admin')->value('id');
        DB::table('users_roles')->insert([
            'user_id' => $super_admin_user->id,
            'role_id' => $super_admin_role,
        ]);
        */
    }
}
