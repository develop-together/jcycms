<?php
use backend\assets\AppAsset;
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
    </head>
    <body class="gray-bg">
    <style>
        .m-t-md {
            margin-top: 0px
        }
    </style>
    <body class="gray-bg">
        <?php $this->beginBody();?>
        <?=$content?>
        <?php $this->endBody();?>
    </body>
    </html>
 <?php $this->endPage();?>

