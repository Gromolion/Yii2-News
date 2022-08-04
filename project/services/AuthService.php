<?php

namespace app\services;

use app\DTO\RegDTO;
use app\models\Role;
use app\models\RoleUser;
use app\models\User;
use Exception;
use Yii;

class AuthService implements AuthServiceInterface
{
    public function register(RegDTO $regDTO): ?User
    {
        try {
            $user = new User();
            $user->username = $regDTO->getUsername();
            $user->email = $regDTO->getEmail();
            $user->setPassword($regDTO->getPassword());
            $user->generateAuthKey();

            $role = Role::find()->where(['name' => 'user'])->one();

            $user->save();

            $roleUser = new RoleUser();
            $roleUser->userId = $user->id;
            $roleUser->roleId = $role->id;
            $roleUser->save();

            return $user;
        } catch (Exception) {
            return null;
        }
    }

    public function login(User $user, int $rememberTime): bool
    {
        try {
            return Yii::$app->user->login($user, $rememberTime);
        } catch (Exception) {
            return false;
        }
    }

    public function logout(): bool
    {
        try {
            return Yii::$app->user->logout();
        } catch (Exception) {
            return false;
        }
    }
}