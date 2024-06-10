<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Création des permissions
        Permission::create(['name' => 'view own requests']);
        Permission::create(['name' => 'submit requests']);
        Permission::create(['name' => 'process requests']);

        // Création des rôles et assignation des permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(['view own requests', 'submit requests']);

        $agent = Role::create(['name' => 'agent']);
        $agent->givePermissionTo('process requests');
    }
}
