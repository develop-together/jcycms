<?php

use yii\helpers\Html;
use common\widgets\ActiveForm AS BAF;
use common\components\BaseConfig;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CarouselSearch */
/* @var $form common\widgets\ActiveForm */
?>

<div class="carousel-search">

    <?php $form = BAF::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => ['class' => 'form-inline'],
        'fieldConfig' => [
            'template' =>"{label}\n{input}\n{error}\n{hint}",
            'labelOptions' => ['class' => 'control-label'],                          
        ],
    ]); ?>

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'status')->dropDownList(BaseConfig::getYesNoItems(), ['prompt' => '全部']); ?>

    <div class="form-group" style="padding-bottom:10px;">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('<i class="fa fa-undo"></i>' . Yii::t('app', 'Clear Query'), ['class' => 'btn btn-default clear-search']) ?>
    </div>

    <?php BAF::end(); ?>

</div>
