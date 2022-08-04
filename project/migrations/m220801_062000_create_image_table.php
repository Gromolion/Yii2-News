<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m220801_062000_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'path' => $this->string(255)->notNull(),
            'width' => $this->integer()->unsigned(),
            'height' => $this->integer()->unsigned(),
            'mime' => $this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image}}');
    }
}
