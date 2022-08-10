<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Админ-панель';
?>

<div class="bg-light my-5 p-5">
    <div id="ajax-content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=Url::to(['/admin'])?>" data-ajax>Админ-панель</a></li>
                <li class="breadcrumb-item"><a href="<?=Url::to(['/admin/news'])?>" data-ajax>Новости</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $news->getId() ?></li>
            </ol>
        </nav>
        <table class="table">
            <tbody>
            <tr>
                <td>id:</td>
                <td><?=$news->getId()?></td>
            </tr>
            <tr>
                <td>Заголовок:</td>
                <td><?=$news->getHeader()?></td>
            </tr>
            <tr>
                <td>Анонс:</td>
                <td><?=$news->getAnnounce()?></td>
            </tr>
            <tr>
                <td>Описание:</td>
                <td><?=$news->getDescription()?></td>
            </tr>
            <tr>
                <td>Просмотры:</td>
                <td><?=$news->getViews()?></td>
            </tr>
            <tr>
                <td>Пользователь:</td>
                <td><a href="<?=Url::to(['/admin/users/show', 'id' => $news->getUser()->id])?>"><?=$news->getUser()->getUsername()?></a></td>
            </tr>
            <tr>
                <td>Опубликована:</td>
                <td><?=$news->getPublished() ? 'Да' : 'Нет'?></td>
            </tr>
            <tr>
                <td>Изображение:</td>
                <?php if(!is_null($news->getImage())) { ?>
                    <td>
                        <img src="<?= Url::to($news->getImage()->path) ?>" alt="">
                    </td>
                <?php } else { ?>
                    <td>Отсутствует</td>
                <?php } ?>
            </tr>
            <tr>
                <td>Создана:</td>
                <td><?= date('d.m.Y H:i:s', $news->getCreatedAt()) ?></td>
            </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mx-auto">
            <a href="<?= Url::to(['/news/show', 'id' => $news->getId()]) ?>" class="btn btn-primary mx-4">Показать на сайте</a>
            <?php if (!$news->getPublished()) { ?>
                <a href="<?= Url::to(['/admin/news/publish', 'id' => $news->getId()]) ?>" class="btn btn-success mx-4">Опубликовать</a>
            <?php } ?>
            <a href="<?= Url::to(['/admin/news/edit', 'id' => $news->getId()]) ?>" class="btn btn-warning mx-4">Редактировать</a>
            <a href="<?= Url::to(['/admin/news/delete', 'id' => $news->getId()]) ?>" class="btn btn-danger mx-4">Удалить</a>
        </div>
    </div>
</div>
