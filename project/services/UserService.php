<?php

namespace app\services;

use Exception;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class UserService extends BaseUserService
{
    public function getUserNewsListWithPagination(ActiveRecord $user): bool|array
    {
        try {
            $query = $user->news()->where(['published' => true]);

            $pagination = new Pagination([
                'defaultPageSize' => Yii::$app->params['newsPerPage'],
                'totalCount' => $query->count()
            ]);

            $news = $query->orderBy(['created_at' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit);

            return [$news, $pagination];
        } catch (Exception) {
            return false;
        }
    }
}