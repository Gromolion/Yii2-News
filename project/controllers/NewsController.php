<?php

namespace app\controllers;

use app\models\Forms\CommentForm;
use app\models\Forms\NewsForm;
use app\services\UserNewsService;
use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;

class NewsController extends MasterController
{
    #[ArrayShape(['access' => "array"])]
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                        'denyCallback' => function ($rule, $action) {
                            return $this->redirect('auth/login');
                        }
                    ]
                ]
            ]
        ];
    }

    protected UserNewsService $newsService;

    public function __construct($id, $module, UserNewsService $newsService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->newsService = $newsService;
    }

    public function actionIndex(): string
    {
        [$news, $pagination] = $this->newsService->getNewsListWithPaginator();

        return $this->render('index', ['news' => $news, 'pagination' => $pagination]);
    }

    public function actionCreate(): Response|string
    {
        $model = Yii::$container->get(NewsForm::class);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $responseFlash = ['success', 'Новость предложена'];

            if (!$model->create()) {
                $responseFlash = ['error', 'Произошла ошибка'];
            }

            $this->setSessionFlash($responseFlash);

            return $this->redirect(['news/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionShow(int $id): Response|string
    {
        $news = $this->newsService->findNews($id);

        if (!$news) {
            $this->setSessionFlash(['error', 'Произошла ошибка']);
            return $this->redirect(['news/index']);
        }

        $model = Yii::$container->get(CommentForm::class);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create($id)) {
                $this->setSessionFlash(['error', 'Произошла ошибка']);
            }
            return $this->refresh();
        }

        [$comments, $pagination] = $this->newsService->getNewsCommentsWithPaginator($news);

        $this->newsService->newsViewed($news);

        return $this->render('show', ['news' => $news, 'comments' => $comments, 'pagination' => $pagination, 'model' => $model]);
    }
}
