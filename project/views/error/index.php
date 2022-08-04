<?php

/** @var yii\web\View $this */

$this->title = $error->getCode()
?>

<h2>Error <?= $error->getCode() ?></h2>
<div>
    <?= $error->getMessage() ?>
</div>



