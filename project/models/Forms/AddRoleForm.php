<?php

namespace app\models\Forms;

use yii\base\Model;

class AddRoleForm extends Model
{
    public $roleId;

    public function rules(): array
    {
        return [
          ['roleId', 'integer'],
          ['roleId', 'required']
        ];
    }
}