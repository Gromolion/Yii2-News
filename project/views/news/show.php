<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = (strlen($news->getHeader()) > 10) ? substr($news->getHeader(),0,7).'...' : $news->getHeader();
?>
<div class="news-show">
    <div class="bg-light m-5 p-4 rounded">
        <h1 class="text-center mb-4"><?= date('d.m.Y H:i:s', $news->getCreatedAt()) . ' — ' . $news->getHeader() ?></h1>
        <div class="d-flex">
            <div>
                <?php if (!is_null($news->getImageId())) { ?>
                    <img src="<?= Url::to($news->getImage()->getPath()) ?>" alt="" style="min-width: 300px">
                <?php } ?>
                <?php if (!is_null($news->getUserId())) { ?>
                    <div class="">Предложена: <a href="<?=Url::to(['/profile/show', 'username' => $news->getUser()->getUsername()])?>"><?= $news->getUser()->getUsername() ?></a></div>
                <?php } ?>
                <div>Просмотров: <?=$news->getViews()?></div>
            </div>
            <div class="p-5"><?= $news->getDescription() ?></div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="<?=Url::to(['/admin/news/edit', 'id' => $news->getId()])?>" class="btn btn-warning mx-3">Редактировать новость</a>
            <a href="<?=Url::to(['/admin/news/delete', 'id' => $news->getId()])?>" class="btn btn-danger">Удалить новость</a>
        </div>
        <div class="mt-5">
            <h3>Комментарии:</h3>
            <?php
                if (!Yii::$app->user->isGuest) {
                    $form = ActiveForm::begin(['id' => 'form-comment-create']);
            ?>
            <?= $form->field($model, 'text')->textarea(['autofocus' => true, 'value' => ''])->label('Добавить комментарий (максимум 400 символов)') ?>
            <div class="d-flex justify-content-center">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
                    <?php
                    ActiveForm::end();
                }
            ?>
            <?php foreach ($comments as $comment) { ?>
                <div class="p-4 m-4 rounded row" style="background-color: lightgray">
                    <h6 class="col-4">
                        <a href="<?=Url::to(['/profile/show', 'username' => $comment->getUser()->getUsername()])?>"><?=$comment->getUser()->getUsername()?></a>
                    </h6>
                    <h6 class="col-4 text-center"><?=date('d.m.Y H:i:s', $comment->getCreatedAt())?></h6>

                    <div class="col-4 text-right">
                        <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()) { ?>
                        <a href="<?=Url::to(['/admin/news/delete-comment', 'newsId' => $news->getId(), 'commentId' => $comment->getId()])?>" class="btn btn-danger btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="p-2"><?=$comment->getText()?></div>
                </div>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-center">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    </div>
</div>
