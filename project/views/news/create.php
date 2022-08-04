<?php

/** @var yii\web\View $this */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Предложить новость';
?>
<div class="news-create">
    <h1><?= Html::encode($this->title) ?></h1>

            <?php $form = ActiveForm::begin(['id' => 'form-news-create', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($model, 'header')->textInput(['autofocus' => true])->label('Заголовок') ?>
            <?= $form->field($model, 'announce')->label('Анонс') ?>
            <?= $form->field($model, 'imageFile')->fileInput()->label('Картинка') ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 10])->label('Описание') ?>
            <div class="d-flex justify-content-center">
                <?= Html::submitButton('Предложить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

</div>
