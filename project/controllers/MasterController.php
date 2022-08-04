<?php

namespace app\controllers;

use app\models\News;
use Yii;
use yii\web\Controller;

class MasterController extends Controller
{
    public string $lastNewsCreatedTime;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $lastNewsCreated = News::getLastNewsCreated();
        if (isset($lastNewsCreated)) {
            $this->lastNewsCreatedTime = $lastNewsCreated->getCreatedAt();
        }
    }

    public function setSessionFlash(array $responseFlash)
    {
        Yii::$app->session->setFlash(...$responseFlash);
    }
}