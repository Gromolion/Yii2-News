<?php

namespace app\models\Mongo;

use Yii;
use yii\db\BaseActiveRecord;
use yii\mongodb\ActiveRecord;
use yii\mongodb\Query;

class NewsViews extends ActiveRecord
{
    public static function collectionName(): string
    {
        return 'news_views';
    }

    public static function setViewedIfNot(string $userIp, BaseActiveRecord $news): bool
    {
        $query = new Query();

        $query->select(['ip', 'news_id'])
            ->from(['course', 'news_views'])
            ->where(['ip' => $userIp, 'news_id' => $news->getId()])
            ->limit(1);

        if (!$query->all()) {
            $collection = Yii::$app->mongodb->getCollection(['course', 'news_views']);
            $collection->insert(['ip' => $userIp, 'news_id' => $news->getId()]);

            $news->incrementViews();
            $news->save();

            return true;
        }

        return false;
    }
}