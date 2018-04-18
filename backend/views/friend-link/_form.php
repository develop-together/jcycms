<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\widgets\fileUploadInput\FileUploadInputWidget;
use common\components\BaseConfig;
use common\models\FriendLink;

/* @var $this yii\web\View */
/* @var $model common\models\FriendLink */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                    <?php $form = BAF::begin([
                                'fieldConfig' => [
                                    'template' =>"{label}\n<div class=\"col-sm-10\">{input}\n{error}</div>\n{hint}",
                                    'labelOptions' => ['class' => 'col-sm-2 control-label'],
                                    'options' => ['class' => 'form-group'],    
                                    'inputOptions' => ['class' => 'form-control'],
                                    'errorOptions' => ['class' => 'help-block m-b-none'],                            
                                ],
                                'options' => ['class' => 'form-horizontal', 'enctype' => 'multipart/form-data'],
                    ]); ?>    
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                        <div class="hr-line-dashed"></div>                        
                        <?= $form->field($model, 'url')->textInput(['maxlength' => true]); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'target')->dropDownList(FriendLink::loadTragetOptions()); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'sort')->textInput(['type' => 'number', 'min' => 0]); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'status')->radioList(BaseConfig::getYesNoItems()); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'image')->widget(FileUploadInputWidget::className(), [
                            'type' => 'feehi_img',
                            ]); ?>
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

