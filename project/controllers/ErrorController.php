<?php

namespace app\controllers;

use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\web\HttpException;

class ErrorController extends MasterController
{
    #[ArrayShape(['error' => "string[]"])]
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex(): string
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception)
            return $this->render('index', ['error'=>$exception]);
        else
            throw new HttpException(404, 'Page not found.');
    }
}