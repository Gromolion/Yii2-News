<?php

namespace app\controllers;

use app\models\Forms\LoginForm;
use app\models\Forms\RegisterForm;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

class AuthController extends MasterController
{
    #[ArrayShape(['access' => "array", 'verbs' => "array"])]
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionRegister(): Response|string
    {
        $model = Yii::$container->get(RegisterForm::class);

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->register()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionLogin(): Response|string
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = Yii::$container->get(LoginForm::class);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->login()) {
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    public function actionLogout(): Response
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}