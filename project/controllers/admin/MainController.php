<?php

namespace app\controllers\admin;

use app\models\News;
use app\models\User;

class MainController extends AdminMasterController
{
    public function actionIndex(): string
    {
        $usersCount = User::find()->count();
        $newsCount = News::find()->count();

        return $this->render('/admin/index', ['usersCount' => $usersCount, 'newsCount' => $newsCount]);
    }
}