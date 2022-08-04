<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    $menuItems = [['label' => 'Главная', 'url' => ['/']]];

    if (isset($this->context->lastNewsCreatedTime)) {
        $menuItems[] = '<li class="form-inline text-light">' . 'Последняя добавленная новость: '. date('d.m.Y H:i:s', $this->context->lastNewsCreatedTime) . '</li>';
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Вход', 'url' => ['/auth/login']];
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/auth/register']];
    } else {
        if (Yii::$app->user->identity->isAdmin()) {
            $menuItems[] = ['label' => 'Админ-панель', 'url' => ['/admin']];
        }
        $menuItems[] = ['label' => 'Профиль', 'url' => ['/profile/show', 'username' => Yii::$app->user->identity->getUsername()]];
        $menuItems[] = '<li>'
            . Html::beginForm(['/auth/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton('Выйти', ['class' => 'btn btn-link logout'])
            . Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems
    ]);

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Alert::widget() ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
