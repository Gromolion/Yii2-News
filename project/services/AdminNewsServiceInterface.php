<?php

namespace app\services;

use app\DTO\NewsDTO;
use yii\db\ActiveRecord;

interface AdminNewsServiceInterface
{
    /**
     * Получить список новостей с пагинацией
     * @return array|false
     */
    public function getNewsListWithPaginator(): array|false;

    /**
     * Обновить данные новости
     * @param NewsDTO $newsDTO
     * @param ActiveRecord $news
     * @return bool
     */
    public function updateNews(NewsDTO $newsDTO, ActiveRecord $news): bool;

    /**
     * Опубликовать новость
     * @param int $id
     * @return bool
     */
    public function setNewsPublished(int $id): bool;

    /**
     * Удалить новость
     * @param int $id
     * @return bool
     */
    public function deleteNews(int $id): bool;
}