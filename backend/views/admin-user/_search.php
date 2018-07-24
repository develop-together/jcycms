<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
Yii::$container->set(\yii\widgets\ActiveField::className(), ['template' => "{label}\n{input}"]);
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
    ]); ?>
    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'status')->dropDownList(User::loadStatusOptions(), []) ?>

    <div class="form-group"  style="-padding-bottom:10px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
