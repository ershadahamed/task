<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RequestFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_reqForm1 = Role::create(['name' => 'requestor']);
        $role_reqForm2 = Role::create(['name' => 'purchaser']);

        $role_reqForm1->syncPermissions(['create', 'delete', 'update', 'read']);
        $role_reqForm2->syncPermissions(['create', 'delete', 'update', 'read']);
    }
}
