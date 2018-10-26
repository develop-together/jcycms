<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Ad;
use common\widgets\ActiveForm AS BAF;
use common\widgets\fileUploadInput\FileUploadInputWidget;
use common\components\BaseConfig;

/* @var $this yii\web\View */
/* @var $model common\models\Options */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = BAF::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>    

                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'description')->textarea(); ?>

                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'input_type')->dropDownList(Ad::loadAdTypes()); ?>                    
                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'url')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'imgUrl')->widget(FileUploadInputWidget::className(), [
                        'type' => 'feehi_img',
                        ]); ?>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="ad-imgurl"><?= $model->getAttributeLabel('size') ?>(<?= Yii::t('app', 'Pixel')?>px): </label>
                        <div class="col-sm-2">
                            <?= $form->field($model, 'width')->textInput(['style' => 'width:80px', 'type' => 'number', 'min' => 0]); ?>
                            <?= $form->field($model, 'height')->textInput(['style' => 'width:80px', 'type' => 'number', 'min' => 0]); ?>
                        </div>
                        <div class="col-sm-8">
                            <p class="alert alert-info"><?= Yii::t('app', 'If you fill in the picture, it will be cut into that size. If you do not fill it, it will not be cut.') ?></p>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'target')->radioList(BaseConfig::getTargetOpenMethod()); ?>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'sort')->textInput(['maxlength' => true, 'min' => 0, 'type' => 'number']); ?>
                    
                    <div class="hr-line-dashed"></div>
                    
                    <?= $form->field($model, 'status')->radioList(BaseConfig::getStatusItems()); ?>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                            
                            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>                        
                        </div>
                </div>
                <?php  BAF::end(); ?>            
            </div>
        </div>
    </div>
</div>

