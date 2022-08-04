<?php

namespace app\commands;

use app\seeders\CommentSeeder;
use app\seeders\NewsSeeder;
use app\seeders\RoleSeeder;
use app\seeders\UserSeeder;
use app\services\ImageService;
use yii\console\Controller;

class SeederController extends Controller
{
    public function actionIndex()
    {
        RoleSeeder::seed();
        UserSeeder::seed();
        NewsSeeder::seed(new ImageService());
        CommentSeeder::seed();
    }
}