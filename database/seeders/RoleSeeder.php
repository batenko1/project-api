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
            'user',
            'admin'
        ];

        $permissions = [
            'index account' => 'Список пользователей',
            'show account' => 'Информация по одному пользователю',
            'create account' => 'Создание пользователя',
            'update account' => "Обновление пользователя",
            'delete account' => 'Удаление пользователя',

            'index role' => 'Список пользователей',
            'show role' => 'Информация по одному пользователю',
            'create role' => 'Создание пользователя',
            'update role' => "Обновление пользователя",
            'delete role' => 'Удаление пользователя',

            'index setting' => 'Список пользователей',
            'show setting' => 'Информация по одному пользователю',
            'create setting' => 'Создание пользователя',
            'update setting' => "Обновление пользователя",
            'delete setting' => 'Удаление пользователя',

            'index template' => 'Список пользователей',
            'show template' => 'Информация по одному пользователю',
            'create template' => 'Создание пользователя',
            'update template' => "Обновление пользователя",
            'delete template' => 'Удаление пользователя',

            'index order' => 'Список пользователей',
            'show order' => 'Информация по одному пользователю',
            'create order' => 'Создание пользователя',
            'update order' => "Обновление пользователя",
            'delete order' => 'Удаление пользователя',

            'index entity' => 'Список пользователей',
            'show entity' => 'Информация по одному пользователю',
            'create entity' => 'Создание пользователя',
            'update entity' => "Обновление пользователя",
            'delete entity' => 'Удаление пользователя',

            'index product' => 'Список пользователей',
            'show product' => 'Информация по одному пользователю',
            'create product' => 'Создание пользователя',
            'update product' => "Обновление пользователя",
            'delete product' => 'Удаление пользователя',

            'index filter' => 'Список пользователей',
            'show filter' => 'Информация по одному пользователю',
            'create filter' => 'Создание пользователя',
            'update filter' => "Обновление пользователя",
            'delete filter' => 'Удаление пользователя',


        ];

        foreach ($roles as $role) {

            if(!Role::query()->where('name', $role)->first()) {
                Role::create(['name' => $role]);
            }
        }

        foreach ($permissions as $key => $permission) {

            if(!Permission::query()->where('name', $key)->first()) {
                Permission::query()->create(['name' => $key, 'title' => $permission]);
            }

            $role = Role::query()->where('name', 'admin')->first();
            $role->givePermissionTo($key);

        }

    }
}
