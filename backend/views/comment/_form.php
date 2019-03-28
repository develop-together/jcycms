<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php $form = BAF::begin(); ?>    
                                    <?= $form->field($model, 'user_id')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'article_id')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'parent_id')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'admin_id')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'status')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'like_count')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'repeat_count')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'contents')->textInput(['maxlength' => true]); ?>

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

