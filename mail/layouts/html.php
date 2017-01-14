<?php

use app\models\Author;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
$a = new Author();
?>
    Здравствуйте <?= $a->username ?>

<?= $content ?>