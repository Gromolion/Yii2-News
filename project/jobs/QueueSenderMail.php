<?php

namespace app\jobs;

use Yii;
use yii\base\BaseObject;
use yii\queue\JobInterface;

class QueueSenderMail extends BaseObject implements JobInterface
{
    public string $newsHeader;

    public function execute($queue)
    {
        Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTextBody('Новость ' . $this->newsHeader . ' набрала ' . Yii::$app->params['viewsForNotification'] . ' просмотров!')
            ->send();
    }
}