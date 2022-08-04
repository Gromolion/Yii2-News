<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role_user}}`.
 */
class m220801_072202_create_role_user_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%role_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'role_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_user_id', '{{%role_user}}', 'user_id', 'user', 'id', 'CASCADE');
        $this->addForeignKey('fk_role_id', '{{%role_user}}', 'role_id', 'role', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%role_user}}');
    }
}
