<?php

/** @var yii\web\View $this */

use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = 'Новости';
?>

<div class="bg-light my-5 p-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=Url::to(['/admin'])?>">Админ-панель</a></li>
            <li class="breadcrumb-item active">Новости</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-center my-3">
        <a href="<?= Url::to('/admin/news/create') ?>" class="btn btn-primary px-5">Добавить новость</a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Заголовок</th>
            <th scope="col">Анонс</th>
            <th scope="col">Описание</th>
            <th scope="col">Просмотры</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Опубликована</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        <?php
            foreach ($news->all() as $newsItem) {
        ?>
        <tr>
            <td><?= (strlen($newsItem->getHeader()) > 15) ? substr($newsItem->getHeader(), 0, 15) . '...' : $newsItem->getHeader() ?></td>
            <td><?= (strlen($newsItem->getAnnounce()) > 20) ? substr($newsItem->getAnnounce(), 0, 17) . '...' : $newsItem->getAnnounce() ?></td>
            <td><?= (strlen($newsItem->getDescription()) > 20) ? substr($newsItem->getDescription(), 0, 17) . '...' : $newsItem->getDescription() ?></td>
            <td><?= $newsItem->views ?></td>
            <td><?= date('d.m.Y H:i:s', $newsItem->getCreatedAt()) ?></td>
            <td><?= $newsItem->getPublished() ? 'Да' : 'Нет' ?></td>
            <td class="container row justify-content-between">
                <div class="col-3">
                    <?php
                        if(!$newsItem->getPublished()) {
                    ?>
                        <a href="<?= Url::to(['/admin/news/publish', 'id' => $newsItem->getId()]) ?>" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg>
                    </a>
                    <?php } ?>
                </div>
                <div class="col-3">
                    <a href="<?= Url::to(['/admin/news/show', 'id' => $newsItem->getId()]) ?>" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-3">
                    <a class="btn btn-danger" href="<?= Url::to(['/admin/news/delete', 'id' => $newsItem->getId()]) ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </a>
                </div>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>

