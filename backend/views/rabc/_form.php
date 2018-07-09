<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\ActiveForm AS BAF;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form common\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title', ['pid' => $pid]) ?>
            <div class="ibox-content">
                <?php $form = BAF::begin(); ?>    
                                    <?= $form->field($model, 'menu_id')->textInput(); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'rule_name')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'method')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>
                                    <?= $form->field($model, 'description')->textarea(['rows' => 6]); ?>

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

