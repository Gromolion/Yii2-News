<?php

/** @var yii\web\View $this */


use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = $user->getUsername();
?>

<div class="bg-light my-5 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=Url::to(['/admin'])?>">Админ-панель</a></li>
            <li class="breadcrumb-item"><a href="<?=Url::to(['/admin/users'])?>">Пользователи</a></li>
            <li class="breadcrumb-item"><?= $user->getUsername() ?></li>
        </ol>
    </nav>
    <table class="table">
        <tbody>
        <tr>
            <td>id:</td>
            <td><?= $user->getId() ?></td>
        </tr>
        <tr>
            <td>Имя:</td>
            <td><?= $user->getUsername() ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?= $user->getEmail() ?></td>
        </tr>
        <tr>
            <td>Хеш пароля</td>
            <td><?= $user->getPasswordHash() ?></td>
        </tr>
        <tr>
            <td>Password reset токен</td>
            <td><?= $user->getPasswordResetToken() ?></td>
        </tr>
        <tr>
            <td>Зарегистрировался</td>
            <td><?= date('d.m.Y H:i:s', $user->getCreatedAt()) ?></td>
        </tr>
        <tr>
            <td>Роли</td>
            <td>
                <ul>
                    <?php foreach ($user->roles()->all() as $role) { ?>
                    <li class="mb-3">
                        <?= $role->getName() ?>
                        <a class="btn btn-sm btn-danger" href="<?= Url::to(['/admin/users/remove-role', 'userId' => $user->getId(), 'roleId' => $role->getId()]) ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </a>
                    </li>
                    <?php } ?>
                </ul>

                <?php if ($roles->exists()) {
                $form = ActiveForm::begin(['id' => 'add-role-form', 'options' => ['style' => 'display: none;']]);
                $options = [];
                    foreach ($roles->all() as $role) {
                        $options[$role->getId()] = $role->getName();
                    }
                ?>
                <?= $form->field($model, 'roleId')->dropDownList($options)->label('Роль') ?>
                <div class="d-flex justify-content-center">

                </div>
                <?php ActiveForm::end(); } ?>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-around mx-auto">
        <a class="btn btn-primary" href="<?= Url::to(['/profile/show', 'username' => $user->getUsername()]) ?>">Открыть профиль</a>
        <?php if ($roles->exists()) { ?>
            <button class="btn btn-success" onclick="addRole()">Добавить роль</button>
        <?php } ?>
        <a class="btn btn-danger" href="<?= Url::to(['/admin/users/delete', 'id' => $user->getId()]) ?>">Удалить пользователя</a>
    </div>
</div>

<script>
    let showed = false
    let form = document.getElementById('add-role-form')
    function addRole() {
        if (!showed) {
            form.style.display = 'block'
            showed = true
        }
        else {
            form.submit()
        }
    }
</script>
