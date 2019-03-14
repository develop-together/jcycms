<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;
use common\widgets\fileUploadInput\FileUploadInputWidget;
use common\components\BaseConfig;

/* @var $this yii\web\View */
/* @var $model common\models\CarouselItem */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title', ['pid' => $pid]) ?>
            <div class="ibox-content">
                <?php $form = BAF::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="col-lg-6 col-sm-6 col-md-6">
                        <?= $form->field($model, 'image')->widget(FileUploadInputWidget::className(), [
                            'type' => 'feehi_img',
                            'widgetOptions' => ['max-width' => '500px', 'min-height' => '250px']
                            ]); ?>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6">
                        <?= $form->field($model, 'carousel_id', ['options' => ['class' => 'hide']])->hiddenInput(['value' => $pid])->label(false); ?>
                        <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => '格式: /article/view/?id=1']); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'caption')->textInput(['maxlength' => true]); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'status')->dropDownList(BaseConfig::getYesNoItems()); ?>
                        <div class="hr-line-dashed"></div>

                        <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'min' => 0]); ?>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                                <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>
                            </div>
                        </div>
                </div>
                <div class="clearfix"></div>
                 <?php  BAF::end(); ?>
            </div>
        </div>
    </div>
</div>

