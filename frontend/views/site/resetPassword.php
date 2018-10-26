<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend', 'Duplicate Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="tm-section">
        <div class="alert alert-info">
            <h1><?= Html::encode($this->title) ?></h1>
            <p><?= Yii::t('frontend', 'Please choose your new password:') ?></p>
        </div>
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
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

