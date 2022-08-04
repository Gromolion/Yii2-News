<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Role model
 *
 * @property int $id
 * @property string $name
 */

class Role extends ActiveRecord
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}