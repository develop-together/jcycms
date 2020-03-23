<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\MallSpu */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = BAF::begin(); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'cid3')->textInput(); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'brand_id')->textInput(); ?>


                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'weight')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'dim')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'saleable')->textInput(); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'valid')->textInput(); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'image_ids')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'sort')->textInput(); ?>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']); ?>
                    </div>
                </div>
                <?php BAF::end(); ?>
            </div>
        </div>
    </div>
</div>

