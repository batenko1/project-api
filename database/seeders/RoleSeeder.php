<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $roles = [
            'user'
        ];

        $permissions = [
            'index account',
            'show account',
            'create account',
            'update account',
            'delete account',

            'index product',
            'show product',
            'create product',
            'update product',
            'delete product',

            'index role',
            'show role',
            'create role',
            'update role',
            'delete role',

            'index setting',
            'show setting',
            'create setting',
            'update setting',
            'delete setting',

            'index template',
            'show template',
            'create template',
            'update template',
            'delete template',

            'index order',
            'show order',
            'create order',
            'update order',
            'delete order',

            'index entity',
            'show entity',
            'create entity',
            'update entity',
            'delete entity',

            'index product',
            'show product',
            'create product',
            'update product',
            'delete product',

            'index filter',
            'show filter',
            'create filter',
            'update filter',
            'delete filter',


        ];

        foreach ($roles as $role) {

            if(!Role::query()->where('name', $role)->first()) {
                Role::create(['name' => $role]);
            }
        }

        foreach ($permissions as $permission) {

            if(!Permission::query()->where('name', $permission)->first()) {
                Permission::query()->create(['name' => $permission]);
            }

            $role = Role::query()->where('name', 'admin')->first();
            $role->givePermissionTo($permission);

        }

    }
}
