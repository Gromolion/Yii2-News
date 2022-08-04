<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Админ-панель';
?>

<div class="bg-light my-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Админ-панель</li>
        </ol>
    </nav>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название таблицы</th>
            <th scope="col">Количество записей</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><a href="<?= Url::to('/admin/users/index') ?>">Пользователи</a></td>
            <td><?= $usersCount ?></td>
        </tr>
        <tr>
            <td><a href="<?= Url::to('/admin/news/index') ?>">Новости</a></td>
            <td><?= $newsCount ?></td>
        </tr>
        </tbody>
    </table>
</div>
