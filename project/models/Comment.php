<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * News model
 *
 * @property integer $id
 * @property string $text
 * @property int $news_id
 * @property int $user_id
 * @property int $created_at
 */
class Comment extends ActiveRecord
{
    public function getId(): int
    {
        return $this->id;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function setNewsId(int $news_id): void
    {
        $this->news_id = $news_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setCreatedAt(int $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUser(): array|ActiveRecord
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->one();
    }
}