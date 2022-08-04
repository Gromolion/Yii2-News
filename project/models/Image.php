<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Image model
 *
 * @property integer $id
 * @property string $path
 * @property string $width
 * @property string $height
 * @property string $mime
 */

class Image extends ActiveRecord
{
    public function getPath(): string
    {
        return $this->path;
    }
}