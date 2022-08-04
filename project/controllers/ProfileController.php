<?php

namespace app\controllers;

use app\services\UserService;
use Yii;
use yii\web\Response;

class ProfileController extends MasterController
{
    protected UserService $userService;

    public function __construct($id, $module, UserService $userService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->userService = $userService;
    }

    public function actionShow(string $username): Response|string
    {
        $user = $this->userService->findUserByUsername($username);

        if (!$user) {
            $this->setSessionFlash(['error', 'Такого пользователя не существует']);
            return $this->goBack();
        }

        return  $this->render('show', ['user' => $user]);
    }

    public function actionNews(string $username): Response|string
    {
        $user = $this->userService->findUserByUsername($username);

        if (!$user) {
            $this->setSessionFlash(['error', 'Такого пользователя не существует']);
            return $this->goBack();
        }

        [$news, $pagination] = $this->userService->getUserNewsListWithPagination($user);

        return $this->render('news', ['user' => $user, 'news' => $news, 'pagination' => $pagination]);
    }
}