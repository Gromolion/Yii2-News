<?php

/** @var yii\web\View $this */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = 'Новости ' . $user->getUsername();
?>

<div class="bg-light my-3 rounded p-4">
    <h3>Новости <a href="<?=Url::to(['/profile/show', 'username' => $user->getUsername()])?>"><?=$user->getUsername()?></a></h3>
    <div>
        <?php foreach($news->all() as $newsItem) { ?>
        <div class="bg-light d-flex my-3 rounded p-4">
            <?php if (!is_null($newsItem->getImageId())) { ?>
                <img src="<?= Url::to($newsItem->getImage()->getPath()) ?>" alt="" style="min-width: 300px">
            <?php } ?>
            <div class="p-3 w-100">
                <a href="<?= Url::to(['/news/show', 'id' => $newsItem->getId()]) ?>"><h1><?= date('d.m.Y H:i:s', $newsItem->getCreatedAt()) . ' — ' . (strlen($newsItem->getHeader()) > 23) ? substr($newsItem->getHeader(),0,20).'...' : $newsItem->getHeader()?></h1></a>
                <div><?= (strlen($newsItem->getDescription()) > 503) ? substr($newsItem->getDescription(),0,500).'...' : $newsItem->getDescription() ?></div>
                <div class="d-flex justify-content-end mt-5">
                    <div>Просмотров: <?= $newsItem->getViews() ?></div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="d-flex justify-content-center">
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
        </div>
    </div>
</div>
