<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * News model
 *
 * @property integer $id
 * @property string $header
 * @property string $announce
 * @property int|null $user_id
 * @property int|null $image_id
 * @property string $description
 * @property string $created_at
 * @property int $views
 * @property bool $published
 */
class News extends ActiveRecord
{
    public function getId(): int
    {
        return $this->id;
    }

    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    public function setAnnounce(string $announce): void
    {
        $this->announce = $announce;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setImageId(int $image_id): void
    {
        $this->image_id = $image_id;
    }

    public function setViews(int $views): void
    {
        $this->views = $views;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function getAnnounce(): string
    {
        return $this->announce;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getImageId(): ?int
    {
        return $this->image_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getPublished(): bool
    {
        return $this->published;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function getImage(): array|ActiveRecord|null
    {
        return $this->hasOne(Image::class, ['id' => 'image_id'])->one();
    }

    public function getUser(): array|ActiveRecord|null
    {
        return $this->hasOne(User::class, ['id' => 'user_id'])->one();
    }
    public static function getLastNewsCreated(): array|ActiveRecord|null
    {
        return static::find()->where(['published' => true])->orderBy(['created_at' => SORT_DESC])->limit(1)->one();
    }

    public function incrementViews()
    {
        $this->setViews($this->getViews() + 1);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, ['news_id' => 'id']);
    }
}