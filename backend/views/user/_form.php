<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\User;
use common\widgets\fileUploadInput\FileUploadInputWidget;
use yii\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model frontend\models\User */
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
                            'options' => ['class' => 'form-horizontal'],
                ]); ?>    

                <?= $form->field($model, 'username')->textInput(['maxlength' => 64]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'avatar')->widget(FileUploadInputWidget::className(),[
                    'type' => 'image'
                ]); ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'email')->textInput(['maxlength' => 64]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'status')->radioList( User::loadStatusOptions() ) ?>
    
                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'password')->passwordInput(['value' => '', 'maxlength' => 512, 'placeHolder' => $model->isNewRecord ? '' : Yii::t('app', 'Not to fill, by default do not modify')]) ?>

                <div class="hr-line-dashed"></div>

                <?= $form->field($model, 'repeat_pwd')->passwordInput(['value' => '', 'maxlength' => 512]) ?>

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

