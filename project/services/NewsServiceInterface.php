<?php

namespace app\services;

use app\DTO\NewsDTO;
use yii\db\ActiveRecord;

interface NewsServiceInterface
{
    /**
     * Добавить новость в БД
     * @param NewsDTO $newsDTO
     * @return bool
     */
    public function storeNews(NewsDTO $newsDTO): bool;

    /**
     * Найти новость по ID
     * @param int $id
     * @return array|ActiveRecord|null
     */
    public function findNews(int $id): array|ActiveRecord|null;
}