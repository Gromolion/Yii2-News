<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class M220804061303CreateCommentTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'news_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('fk_news_id', '{{%comment}}', 'news_id', '{{%news}}', 'id', 'CASCADE');
        $this->addForeignKey('fk_user_id', '{{%comment}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
