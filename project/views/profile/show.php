<?php

/** @var yii\web\View $this */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = $user->getUsername();
?>

<div class="bg-light d-flex justify-content-between my-3 rounded p-4">
    <div>
        <p>Имя пользователя: <?=$user->getUsername()?></p>
        <p>Email: <?=$user->getEmail()?></p>
        <p>Общее количество просмотров новостей: <?=$user->news()->exists() ? $user->summaryViews() : 0?></p>
    </div>
    <div class="d-block">
        <p>
            <a href="<?=Url::to(['profile/news', 'username' => $user->getUsername()])?>" class="btn btn-sm btn-primary">Посмотреть новости пользователя</a>
        </p>
    </div>
</div>
