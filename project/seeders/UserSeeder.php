<?php

namespace app\seeders;

use app\models\Role;
use app\models\RoleUser;
use app\models\User;
use Faker\Factory;

class UserSeeder
{
    public static function seed(): void
    {
        foreach (['admin', 'user'] as $roleName) {
            $role = Role::find()->where(['name' => $roleName])->one();

            $user = new User();
            $user->setUsername($roleName);
            $user->setEmail($roleName . '@' . $roleName . '.ru');
            $user->generateAuthKey();
            $user->setPassword($roleName);
            $user->save();
            $roleUser = new  RoleUser();
            $roleUser->setUserId($user->getId());
            $roleUser->setRoleId($role->getId());
            $roleUser->save();
        }

        $faker = Factory::create();
        $role = Role::find()->where(['name' => $user])->one();
        for ($i = 1; $i < 25; $i++) {
            $user = new User();
            $user->setUsername($faker->userName());
            $user->setEmail($faker->email());
            $user->generateAuthKey();
            $user->setPassword($faker->password(8));
            $user->save();
            $roleUser = new  RoleUser();
            $roleUser->setUserId($user->getId());
            $roleUser->setRoleId($role->getId());
            $roleUser->save();
        }
    }
}