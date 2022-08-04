<?php

namespace app\controllers\admin;

use app\models\Forms\NewsForm;
use app\services\AdminNewsService;
use Yii;
use yii\web\Response;

class NewsController extends AdminMasterController

{
    private AdminNewsService $newsService;

    public function __construct($id, $module, AdminNewsService $newsService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->newsService = $newsService;
    }

    public function actionIndex(): string
    {
        [$news, $pagination] = $this->newsService->getNewsListWithPaginator();

        return $this->render('index', ['news' => $news, 'pagination' => $pagination]);
    }

    public function actionShow(int $id): Response|string
    {
        $news = $this->newsService->findNews($id);

        if (!$news) {
            $this->setSessionFlash(['error', 'Такой новости не существует']);

            return $this->redirect(['admin/news/index']);
        }

        return $this->render('show', ['news' => $news]);
    }

    public function actionCreate(): Response|string
    {
        $model = Yii::$container->get(NewsForm::class);

        if (!$model->load(Yii::$app->request->post()) || !$model->validate()) {
            $responseFlash = ['success', 'Новость добавлена'];

            if (!$model->create()) {
                $responseFlash = ['error', 'Произошла ошибка'];
            }

            $this->setSessionFlash($responseFlash);

            return $this->redirect(['admin/news/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit(int $id): Response|string
    {
        $news = $this->newsService->findNews($id);

        $model = Yii::$container->get(NewsForm::class);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->update($news)) {
                $this->setSessionFlash(['success', 'Новость изменена']);

                return $this->redirect(['admin/news/show', 'id' => $news->getId()]);
            } else {
                $this->setSessionFlash(['error', 'Произошла ошибка']);

                return $this->redirect(['admin/news/index']);
            }
        }

        return $this->render('create', ['model' => $model, 'news' => $news]);
    }

    public function actionPublish(int $id): Response
    {
        $responseFlash = ['success', 'Новость опубликована'];

        if (!$this->newsService->setNewsPublished($id)) {
            $responseFlash = ['error', 'Произошла ошибка'];
        }

        $this->setSessionFlash($responseFlash);

        return $this->redirect(['admin/news/index']);
    }

    public function actionDelete(int $id): Response
    {
        $responseFlash = ['success', 'Новость удалена'];

        if (!$this->newsService->deleteNews($id)) {
            $responseFlash = ['error', 'Произошла ошибка'];
        }

        $this->setSessionFlash($responseFlash);

        return $this->redirect(['admin/news/index']);
    }

    public function actionDeleteComment(int $newsId, int $commentId): Response
    {
        if (!$this->newsService->deleteComment($commentId)) {
            $this->setSessionFlash(['error', 'Произошла ошибка']);
        }

        return $this->redirect(['/news/show', 'id' => $newsId]);
    }
}