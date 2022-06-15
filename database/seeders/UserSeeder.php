<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Arill',
            'email' => 'arill.kp21@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        $role_1 = Role::create(['name' => 'admin']);
        $role_2 = Role::create(['name' => 'ctp']);
        $role_3 = Role::create(['name' => 'logistic']);

        $permission_1 = Permission::create(['name' => 'create']);
        $permission_2 = Permission::create(['name' => 'delete']);
        $permission_3 = Permission::create(['name' => 'update']);
        $permission_4 = Permission::create(['name' => 'read']);

        // $role_2->syncPermissions([$permission_1, $permission_2, $permission_3, $permission_4]);
        $role_2->syncPermissions([$permission_1, $permission_2, $permission_3, $permission_4]);
        $role_3->syncPermissions([$permission_1, $permission_2, $permission_3, $permission_4]);

        $user->assignRole($role_1);
    }
}
