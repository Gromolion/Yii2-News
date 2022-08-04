<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = isset($news) ? 'Редактировать новость' : 'Создать новость';
?>
<div class="news-create">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=Url::to(['/admin'])?>">Админ-панель</a></li>
            <li class="breadcrumb-item"><a href="<?=Url::to(['/admin/news'])?>">Новости</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($news) ? 'Редактирование новости' : 'Создание новости' ?></li>
        </ol>
    </nav>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['id' => 'form-news-create', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'header')->textInput(['autofocus' => true, 'value' => isset($news) ? $news->getHeader() : ''])->label('Заголовок') ?>
    <?= $form->field($model, 'announce')->textInput(['value' => isset($news) ? $news->getAnnounce() : ''])->label('Анонс') ?>
    <?= $form->field($model, 'imageFile')->fileInput()->label('Картинка') ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 10, 'value' => isset($news) ? $news->getDescription() : ''])->label('Описание') ?>
    <div class="d-flex justify-content-center">
        <?= Html::submitButton(isset($news) ? 'Обновить' : 'Добавить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

