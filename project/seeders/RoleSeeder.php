<?php

namespace app\seeders;

use app\models\Role;

class RoleSeeder
{
    public static function seed(): void
    {
        $role = new Role();
        $role->name = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->save();
    }
}