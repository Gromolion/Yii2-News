<?php

namespace app\migrations;

use Faker\Factory;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m220801_072156_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string('20')->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
