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

            'index user' => 'Список пользователей',
            'show user' => 'Информация по одному пользователю',
            'create user' => 'Создание пользователя',
            'store user' => 'Сохранение пользователя',
            'edit user' => 'Редактирование пользователя',
            'update user' => "Обновление пользователя",
            'delete user' => 'Удаление пользователя',

            'index account' => 'Список покупателей',
            'show account' => 'Информация по одному покупателю',
            'create account' => 'Создание покупателя',
            'store account' => 'Сохранение покупателя',
            'edit account' => 'Редактирование покупателя',
            'update account' => "Обновление покупателя",
            'delete account' => 'Удаление покупателя',

            'index role' => 'Список ролей',
            'show role' => 'Информация по одной роли',
            'create role' => 'Создание роли',
            'store role' => 'Сохранение роли',
            'edit role' => 'Редактирование роли',
            'update role' => "Обновление роли",
            'delete role' => 'Удаление роли',

            'index setting' => 'Список настроек',
            'show setting' => 'Информация по одной настройке',
            'create setting' => 'Создание настройки',
            'store setting' => 'Сохранение настройки',
            'edit setting' => 'Редактирование настройки',
            'update setting' => "Обновление настройки",
            'delete setting' => 'Удаление настройки',

            'index template' => 'Список шаблонов',
            'show template' => 'Информация по одному шаблону',
            'create template' => 'Создание шаблона',
            'store template' => 'Сохранение шаблона',
            'edit template' => 'Редактирование шаблона',
            'update template' => "Обновление шаблона",
            'delete template' => 'Удаление шаблона',

            'index order' => 'Список заказов',
            'show order' => 'Информация по одному заказу',
            'create order' => 'Создание заказа',
            'store order' => 'Сохранение заказа',
            'edit order' => 'Редактирование заказа',
            'update order' => "Обновление заказа",
            'delete order' => 'Удаление заказа',

            'index entity' => 'Список категорий',
            'show entity' => 'Информация по одной категории',
            'create entity' => 'Создание категории',
            'store entity' => 'Сохранение категории',
            'edit entity' => 'Редактирование категории',
            'update entity' => "Обновление категории",
            'delete entity' => 'Удаление категории',

            'index product' => 'Список товаров',
            'show product' => 'Информация по одному товару',
            'create product' => 'Создание товара',
            'store product' => 'Сохранение товара',
            'edit product' => 'Редактирование товара',
            'update product' => "Обновление товара",
            'delete product' => 'Удаление товара',

            'index filter' => 'Список фильтров',
            'show filter' => 'Информация по одному фильтру',
            'create filter' => 'Создание фильтра',
            'update filter' => "Обновление фильтра",
            'delete filter' => 'Удаление фильтра',

            'index chat' => 'Доступ к чату'


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
