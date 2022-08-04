<?php

namespace app\services;

use yii\web\UploadedFile;

interface ImageServiceInterface
{
    /**
     * Сохранить в хранилище загруженный файл
     * @param UploadedFile $image
     * @return int|null
     */
    public function store(UploadedFile $image): ?int;

    /**
     * Сохранить в хранилище файл с указанным путем
     * @param string $imagePath
     * @return int|null
     */
    public function storeFromPath(string $imagePath): ?int;
}