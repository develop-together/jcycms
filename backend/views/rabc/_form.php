<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\components\BaseConfig;
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
                    <?= $form->field($model, 'menu_id', ['options' => ['class' => 'hide']])->hiddenInput(['value' => $pid]); ?>
                    
                    <?= $form->field($model, 'rule_format', ['options' => ['class' => 'hide']])->hiddenInput(); ?>

                    <?= $form->field($model, 'rule_name')->textInput(['maxlength' => true]); ?>

                    <div class="hr-line-dashed"></div>

                    <?= $form->field($model, 'method')->dropDownList(BaseConfig::getHttpMethods(), ['prompt' => '请选择']); ?>

                    <div class="hr-line-dashed"></div>
    
                    <?= $form->field($model, 'sort')->textInput(['style' => 'width:100px', 'min' => 0, 'type' => 'number']); ?>

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

<?php 
    $this->registerJs(<<<EOT
        $("#authitem-method").bind('blur', function() {
            var url = $("#authitem-rule_name").val();
            if (url.substr(0, 1) !== '/') {
                url = '/' + url;
            }
            var method = $(this).val().toUpperCase();
            $("#authitem-rule_format").val(url + ':' + method);
        });    
EOT
    );
 ?>

