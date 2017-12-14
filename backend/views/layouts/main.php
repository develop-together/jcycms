<?php
use backend\assets\AppAsset;
use backend\grid\ActionColumn;
use yii\helpers\Html;

AppAsset::register($this);
?>
 <?php $this->beginPage();?>
 <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <?=Html::csrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>
        <?= $this->render("../widgets/_language-js") ?>
    </head>
    <body class="gray-bg">
    <style>
        .m-t-md {
            margin-top: 0px
        }
    </style>
    <body class="gray-bg">
        <?php $this->beginBody();?>
        <div class="wrapper wrapper-content">
            <?= $this->render('../widgets/_flash') ?>
            <?=$content?>
        </div>
        <?php $this->endBody();?>
    </body>
    </html>
 <?php $this->endPage();?>

