<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * RoleUser model
 *
 * @property string $user_id
 * @property string $role_id
 */

class RoleUser extends ActiveRecord
{
    public function setUserId(string $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setRoleId(string $role_id): void
    {
        $this->role_id = $role_id;
    }
}