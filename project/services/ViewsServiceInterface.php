<?php

namespace app\services;

use app\models\News;
use yii\db\BaseActiveRecord;

interface ViewsServiceInterface
{
    /**
     * Обработка просмотра новости
     * @param News $news
     * @return void
     */
    public function countViews(BaseActiveRecord $news): void;

    /**
     * Засчитывание просмотра новости, если пользователь смотрит новость впервые
     * @param News $news
     * @return bool
     */
    public function setViewedIfNot(BaseActiveRecord $news): bool;

    /**
     * Отправка письма на почту каждое заданное кол-во просмотров
     * @param News $news
     * @return void
     */
    public function checkCountViewsForEmail(BaseActiveRecord $news): void;
}