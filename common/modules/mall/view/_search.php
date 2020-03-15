<?php

use yii\helpers\Html;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\search\MallSpecGroupSearch */
/* @var $form common\widgets\ActiveForm */
?>

<div class="mall-spec-group-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
        'template' =>"{label}\n{input}\n{error}\n{hint}",
        'labelOptions' => ['class' => 'control-label'],
    ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

			<?= $form->field($model, 'cid') ?>

			<?= $form->field($model, 'name') ?>

			<?= $form->field($model, 'created_at') ?>

			<?= $form->field($model, 'updated_at') ?>

    <div class="form-group" style="padding-bottom:10px;">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i> 清空查询', ['class' =>
        'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
