<?php

namespace app\services;

use app\jobs\QueueSenderMail;
use app\models\Mongo\NewsViews;
use Yii;
use yii\db\BaseActiveRecord;

class MongoViewsService implements ViewsServiceInterface
{
    private int $viewsForNotification;

    public function __construct()
    {
        $this->viewsForNotification = Yii::$app->params['viewsForNotification'];
    }

    public function countViews(BaseActiveRecord $news): void
    {
        if ($this->setViewedIfNot($news)) {
            $this->checkCountViewsForEmail($news);
        }
    }

    public function setViewedIfNot(BaseActiveRecord $news): bool
    {
        return NewsViews::setViewedIfNot(Yii::$app->request->getUserIP(), $news);
    }

    public function checkCountViewsForEmail(BaseActiveRecord $news): void
    {
        if ($news->views % $this->viewsForNotification === 0) {
            Yii::$app->queue->push(new QueueSenderMail(['newsHeader' => $news->getHeader()]));
        }
    }
}