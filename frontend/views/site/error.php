<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="row">
    <div  class="tm-section">
        <div class="site-error">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p>
                <?= Yii::t('frontend', 'The above error occurred while the Web server was processing your request.') ?>
            </p>
            <p>
                <?= Yii::t('frontend', 'Please contact us if you think this is a server error. Thank you.') ?>
            </p>
        </div>        
    </div>
    <?php
        $this->registerJs(<<<EOT
            $("#tmNavbar ul > li > a.nav-link").bind('click', function() {
                window.location.href = $(this).attr('href');
            })
EOT

        );
    ?>
</div>

