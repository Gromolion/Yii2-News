<?php

namespace app\DTO;

use yii\web\UploadedFile;

class NewsDTO
{
    private int $id;
    private string $header;
    private string $announce;
    private string $description;
    private int $userId;
    private ?UploadedFile $image;
    private int $created_at;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setHeader(string $header): void
    {
        $this->header = $header;
    }

    public function setAnnounce(string $announce): void
    {
        $this->announce = $announce;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setImage(?UploadedFile $image): void
    {
        $this->image = $image;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function setCreatedAt(int $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getHeader(): string
    {
        return $this->header;
    }

    public function getAnnounce(): string
    {
        return $this->announce;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    public function getCreatedAt(): int
    {
        return $this->created_at;
    }
}