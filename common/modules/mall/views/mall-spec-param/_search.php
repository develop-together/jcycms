<?php

use yii\helpers\Html;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\search\MallSpecParamSearch */
/* @var $form common\widgets\ActiveForm */
?>

<div class="mall-spec-param-search">

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

			<?= $form->field($model, 'group_id') ?>

			<?= $form->field($model, 'name') ?>

			<?= $form->field($model, 'numeric') ?>

			<?php // echo $form->field($model, 'unit') ?>

			<?php // echo $form->field($model, 'generic') ?>

			<?php // echo $form->field($model, 'searching') ?>

			<?php // echo $form->field($model, 'segments') ?>

    <div class="form-group" style="padding-bottom:10px;">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i> 清空查询', ['class' =>
        'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
