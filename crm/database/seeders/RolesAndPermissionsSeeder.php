<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cache here
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // list of permissions from my project
        $permissions = [
            'create',
            'edit',
            'delete',
        ];

        // add permissions to the database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // add roles and their rights
        $roles = [
            'admin' => ['create', 'edit', 'delete'],
            'writer' => ['create'],
            'editor' => ['edit'],
        ];

        // add roles with permissions to the database
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        // assign admin role to the first user in the database
        $user = User::find(1);
        $user->assignRole('admin');
    }
}
