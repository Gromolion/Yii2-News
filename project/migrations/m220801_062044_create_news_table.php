<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%news}}`.
 */
class m220801_062044_create_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'header' => $this->string(120)->notNull(),
            'announce' => $this->string(500)->notNull(),
            'description' => $this->text(),
            'views' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->null(),
            'published' => $this->boolean()->notNull()->defaultValue(false),
            'image_id' => $this->integer()->null(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_user_id', '{{%news}}', 'user_id', 'user', 'id', 'SET NULL');
        $this->addForeignKey('fk_image_id', '{{%news}}', 'image_id', 'image', 'id', 'SET NULL');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%news}}');
    }
}
