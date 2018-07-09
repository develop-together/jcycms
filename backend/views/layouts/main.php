<?php
use backend\assets\AppAsset;
use backend\grid\ActionColumn;
use common\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;

$config = Config::loadData(true);

AppAsset::register($this);
?>
 <?php $this->beginPage();?>
 <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <meta name="referrer" content="no-referrer"/>
        <?=Html::csrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>

        <?php if (!$config['deny_external_access']): ?>
            <script type="text/javascript">
                function denyExternalAccess(url)
                {
                  // ，但是必须在页面加载前起作用，不然页面还是会一闪而过。   
                  if (parent.window.location.host != window.location.host && top.window.location.href != window.location.href) {
                        top.window.location.href = url;
                    } else if (top == self) {
                        top.window.location.href = url;
                    } 
                }
                denyExternalAccess("<?= Url::toRoute(['/']) ?>");
            </script>            
        <?php endif ?>

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
            <?= $content ?>
        </div>
        <?php $this->endBody();?>
    </body>
    </html>
 <?php $this->endPage();?>

