<?php

use yii\helpers\Html;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model backend\models\search\OptionsSearch */
/* @var $form common\widgets\ActiveForm */
?>

<div class="options-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' =>"{label}\n{input}\n{error}\n{hint}",
            'labelOptions' => ['class' => 'control-label'],                          
        ],
    ]); ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group" style="padding-bottom:10px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i>' . Yii::t('app', 'Clear Query'), ['class' => 'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
