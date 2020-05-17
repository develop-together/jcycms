<?php

use yii\helpers\Html;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\search\MallSpuSearch */
/* @var $form common\widgets\ActiveForm */
/* @var $form common\widgets\ActiveField */
?>
<style>
    .selectDiv {
        width: 150px;
        height: 44px;
    }
    .selectDiv select.form-control {
        width: 100%;
    }
    .selectDiv p {
        margin-bottom: 10px;
    }
</style>
<div class="mall-spu-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}\n{hint}",
            'labelOptions' => ['class' => 'control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'cid3')->catalogDropDownList() ?>
    <?php echo $form->field($model, 'brand_id', ['template' => "{input}\n{error}\n{hint}"])->dropDownList([], ['prompt' => '请选择商品品牌']) ?>
    <?= $form->field($model, 'title') ?>
    <?php // echo $form->field($model, 'cid2') ?>

    <?php // echo $form->field($model, 'cid3') ?>


    <?php // echo $form->field($model, 'brand_name') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'dim') ?>

    <?php  echo $form->field($model, 'flag_saleable')->dropDownList(\common\components\BaseConfig::getYesNoItems()) ?>

    <?php // echo $form->field($model, 'valid') ?>

    <?php // echo $form->field($model, 'image_ids') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <div class="form-group" style="padding-bottom:10px;">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i> 清空查询', ['class' =>
            'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
