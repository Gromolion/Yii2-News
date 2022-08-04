<?php

namespace app\controllers\admin;

use app\controllers\MasterController;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\filters\AccessControl;

class AdminMasterController extends MasterController
{
    #[ArrayShape(['access' => "array"])]
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin();
                        }
                    ]
                ],
                'denyCallback' => function ($rule, $action) {
                    return $this->redirect(['auth/login']);
                }
            ]
        ];
    }
}