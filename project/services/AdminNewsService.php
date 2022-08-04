<?php

namespace app\services;

use app\DTO\NewsDTO;
use app\models\Comment;
use app\models\News;
use Exception;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class AdminNewsService extends BaseNewsService implements AdminNewsServiceInterface
{
    public function getNewsListWithPaginator(): array|false
    {
        try {
            $query = News::find();

            $pagination = new Pagination([
                'defaultPageSize' => Yii::$app->params['adminNewsPerPage'],
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

    public function updateNews(NewsDTO $newsDTO, ActiveRecord $news): bool
    {
        try {
            $news->setHeader($newsDTO->getHeader());
            $news->setAnnounce($newsDTO->getAnnounce());
            $news->setDescription($newsDTO->getDescription());
            $news->setCreatedAt($newsDTO->getCreatedAt());

            $image = $newsDTO->getImage();

            if ($image) {
                $news->setImageId($this->imageService->store($image));
            }

            return $news->save();

        } catch (Exception) {
            return false;
        }
    }

    public function setNewsPublished(int $id): bool
    {
        try {
            $news = $this->findNews($id);
            $news->setPublished(true);
            return $news->save();
        } catch (Exception) {
            return false;
        }
    }

    public function deleteNews(int $id): bool
    {
        try {
            $news = $this->findNews($id);
            return (bool)$news->delete();
        } catch (Exception) {
            return false;
        }
    }

    public function deleteComment(int $commentId): bool
    {
        try {
            Comment::find()->where(['id' => $commentId])->one()->delete();

            return true;
        } catch (Exception)
        {
            return false;
        }
    }
}