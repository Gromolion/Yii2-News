<?php

namespace app\services;

interface UserServiceInterface
{
    /**
     * Найти пользователя по ID
     * @param int $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findUser(int $id): array|\yii\db\ActiveRecord|null;
}