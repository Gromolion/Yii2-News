<?php

namespace app\services;

use app\models\Comment;
use app\models\News;
use Exception;
use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;

class UserNewsService extends BaseNewsService implements UserNewsServiceInterface
{
    protected MongoViewsService $viewsService;

    public function __construct(ImageService $imageService, MongoViewsService $viewsService)
    {
        parent::__construct($imageService);
        $this->viewsService = $viewsService;
    }

    public function getNewsListWithPaginator(): array|false
    {
        try {
            $query = News::find()->where(['published' => true]);

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

    public function newsViewed(ActiveRecord $news): void
    {
        $this->viewsService->countViews($news);
    }

    public function createComment(int $newsId, string $text): bool
    {
        try {
            $comment = new Comment();
            $comment->setNewsId($newsId);
            $comment->setUserId(Yii::$app->user->id);
            $comment->setText($text);
            $comment->setCreatedAt(time());
            $comment->save();

            return true;
        } catch (Exception) {
            return false;
        }
    }

    public function getNewsCommentsWithPaginator(ActiveRecord $news): bool|array
    {
        try {
            $query = $news->comments();

            $pagination = new Pagination([
                'defaultPageSize' => Yii::$app->params['commentsPerPage'],
                'totalCount' => $query->count()
            ]);

            $comments = $query->orderBy(['created_at' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return [$comments, $pagination];
        } catch (Exception) {
            return false;
        }
    }
}