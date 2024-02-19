<?php

namespace App\Traits;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

trait RoleControlTrait {

    public function storePermissions($type): void
    {

        $permissions = [
            'index '.$type,
            'show '.$type,
            'create '.$type,
            'update '.$type,
            'delete '.$type,
        ];

        foreach ($permissions as $permission) {

            if(!Permission::query()->where('name', $permission)->first()) {
                Permission::query()->create(['name' => $permission]);

                $role = Role::query()->where('name', 'admin')->first();

                $role->givePermissionTo($permission);
            }

        }

    }

}
