<?php

namespace app\services;

use yii\db\ActiveRecord;

interface UserNewsServiceInterface
{
    /**
     * Получить список новостей с пагинацией
     * @return array|false
     */
    public function getNewsListWithPaginator(): array|false;

    /**
     * Обработка просмотра новости
     * @param ActiveRecord $news
     * @return void
     */
    public function newsViewed(ActiveRecord $news): void;
}