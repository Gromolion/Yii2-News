<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220801_053723_create_user_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
