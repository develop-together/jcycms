<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group"  style="padding-bottom:10px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i>' . Yii::t('app', 'Clear Query'), ['class' => 'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
