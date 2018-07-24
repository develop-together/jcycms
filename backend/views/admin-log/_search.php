<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model backend\models\search\AdminLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-log-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'route') ?>

    <div class="form-group"  style="padding-bottom:10px;">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i>清空查询', ['class' => 'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
