<?php

namespace app\seeders;

use app\models\News;
use app\models\User;
use app\services\ImageService;
use dicr\file\File;
use Faker\Factory;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class NewsSeeder
{
    public static function seed(ImageService $imageService): void
    {
        $faker = Factory::create();
        $images = FileHelper::findFiles( 'web/seeder');
        $users = User::find()->all();

        for ($i = 1; $i < 25; $i++) {
            $news = new News();
            $news->setHeader($faker->text(20));
            $news->setAnnounce($faker->text());
            $news->setDescription($faker->text(500));
            $news->setViews(9);
            $news->setPublished((bool)(rand(0, 1)));
            $news->setImageId($imageService->storeFromPath($images[array_rand($images)]));
            $news->setUserId($users[array_rand($users)]->getId());
            $news->setCreatedAt(time());

            $news->save();
        }
    }
}