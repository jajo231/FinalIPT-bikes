<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $user2 = User::create([
            'name' => 'Client',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $admin = Role::create(['name' => 'admin']);
        $client = Role::create(['name' => 'client']);

        $viewDashboard = Permission::create(['name' => 'view-dashboard']);
        $viewLogs = Permission::create(['name' => 'view-logs']);
        $create = Permission::create(['name' => 'create']);
        $delete = Permission::create(['name' => 'delete']);
        $manage = Permission::create(['name' => 'manage']);

        $client->givePermissionTo($viewDashboard);

        $admin->syncPermissions([
            $viewDashboard
        ]);

        $admin->givePermissionTo($viewLogs);
        $admin->givePermissionTo($create);
        $admin->givePermissionTo($delete);
        $admin->givePermissionTo($manage);

        $user1->assignRole($admin);
        $user2->assignRole($client);
    }
}
