<?php

namespace app\services;

use app\DTO\NewsDTO;
use app\models\News;
use Exception;
use yii\db\ActiveRecord;

class BaseNewsService implements NewsServiceInterface
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function storeNews(NewsDTO $newsDTO): bool
    {
        try {
            $news = new News();
            $news->setHeader($newsDTO->getHeader());
            $news->setAnnounce($newsDTO->getAnnounce());
            $news->setDescription($newsDTO->getDescription());
            $news->setUserId($newsDTO->getUserId());
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

    public function findNews(int $id): array|ActiveRecord|null
    {
        return News::find()->where(['id' => $id])->one();
    }
}