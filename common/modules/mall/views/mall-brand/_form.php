<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\MallBrand */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('@backend/views/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = BAF::begin([
                    'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'brand_code')->textInput(['maxlength' => true]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'min' => 0]); ?>

                <div class="hr-line-dashed"></div>
                <?= $form->field($model, 'image')->widget(\common\widgets\fileUploadInput\FileUploadInputWidget::className(), [
                    'type' => 'feehi_img',
                ]); ?>
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

