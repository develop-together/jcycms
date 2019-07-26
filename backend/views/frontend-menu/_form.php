<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Menu;
use common\components\Utils;
use yii\widgets\ActiveForm AS BAF;
$lists = Menu::getFrontendQuery()->asArray()->all();
$menuTree = Utils::reference_delivery_tree($lists, 'id', 'parent_id');

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <?php   $form = BAF::begin([
                            'fieldConfig' => [
                                'template' =>"{label}\n<div class=\"col-sm-10\">{input}\n{error}</div>\n{hint}",
                                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                                'options' => ['class' => 'form-group'],    
                                'inputOptions' => ['class' => 'form-control'],
                                'errorOptions' => ['class' => 'help-block m-b-none'],                            
                            ],
                            'options' => ['class' => 'form-horizontal'],
                ]); ?>    
                        <?= $form->field($model, 'parent_id')->dropDownList(Menu::getDrowDownList($menuTree), ['prompt' => '请选择']); ?>
                        <div class="hr-line-dashed"></div>                        
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                        <div class="hr-line-dashed"></div>                        
                        <?= $form->field($model, 'is_absolute_url')->radioList(Menu::loadAbsoluteOptions()); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'url')->textInput(); ?>
                        <div class="hr-line-dashed"></div>                       
                        <?= $form->field($model, 'method')->dropDownList(Menu::loadMethodOptions(), ['prompt' => '请选择']); ?>
                        <div class="hr-line-dashed"></div>                        
                        <?= $form->field($model, 'target')->dropDownList(Menu::loadTragetOptions()); ?>
                        <div class="hr-line-dashed"></div>                     
                        <?= $form->field($model, 'sort')->textInput(['maxlength' => true, 'type' => 'number', 'min' => 0]); ?>
                        <div class="hr-line-dashed"></div>                       
                        <?= $form->field($model, 'is_display')->radioList(Menu::loadDisplayOptions()); ?>
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

