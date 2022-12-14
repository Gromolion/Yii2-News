<?php

/** @var yii\web\View $this */

use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

$this->title = 'Админ-панель';
?>
<div class="bg-light my-5 p-5">
    <div id="ajax-content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?=Url::to(['/admin'])?>" data-ajax>Админ-панель</a></li>
                <li class="breadcrumb-item active">Пользователи</li>
            </ol>
        </nav>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">Имя пользователя</th>
                <th scope="col">Email</th>
                <th scope="col">Дата регистрации</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users->all() as $user) { ?>
                <tr>
                    <td><?= $user->getUsername() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= date('d.m.Y H:i:s', $user->getCreatedAt()) ?></td>
                    <td class="container row justify-content-between">
                        <a href="<?= Url::to(['/admin/users/show', 'id' => $user->getId()]) ?>" class="btn btn-success col-5" data-ajax>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </a>
                        <a href="<?= Url::to(['/admin/users/delete', 'id' => $user->getId()]) ?>" class="btn btn-danger col-5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            <?= LinkPager::widget(['pagination' => $pagination, 'linkOptions' => ['class' => 'page-link', 'data-ajax' => '']]) ?>
        </div>
    </div>
</div>
