<?php

namespace app\seeders;

use app\models\Comment;
use app\models\News;
use app\models\User;
use Faker\Factory;

class CommentSeeder
{
    public static function seed(): void
    {
        $faker = Factory::create();
        $news = News::find()->all();
        $users = User::find()->all();

        for ($i = 1; $i < 100; $i++) {
            $comment = new Comment();
            $comment->setText($faker->text(rand(50, 300)));
            $comment->setNewsId($news[array_rand($news)]->getId());
            $comment->setUserId($users[array_rand($users)]->getId());
            $comment->setCreatedAt(time());
            $comment->save();
        }
    }
}