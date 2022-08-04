<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Регистрация';
?>
<div class="auth-register">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Имя пользователя') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
            <div class="form-group">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>