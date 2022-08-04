<?php

namespace app\services;

use app\models\User;
use yii\db\ActiveRecord;

class BaseUserService implements UserServiceInterface
{
    public function findUser(int $id): array|ActiveRecord|null
    {
        return User::find()->where(['id' => $id])->one();
    }

    public function findUserByUsername(string $username): array|ActiveRecord|null
    {
        return User::find()->where(['username' => $username])->one();
    }
}