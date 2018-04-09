<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Menu;
use common\components\Utils;
use yii\widgets\ActiveForm AS BAF;
$lists = Menu::getBackendQuery()->asArray()->all();
$menuTree = Utils::tree_bulid($lists, 'id', 'parent_id');
/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form yii\widgets\ActiveForm */
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
                        
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true]); ?>
                        
                        <?= $form->field($model, 'is_absolute_url')->radioList(Menu::loadAbsoluteOptions()); ?>

                        <?= $form->field($model, 'url')->textInput(); ?>
                        
                        <?= $form->field($model, 'method')->dropDownList(Menu::loadMethodOptions(), ['prompt' => '请选择']); ?>
                        
                        <?= $form->field($model, 'icon')->widget(\backend\widgets\iconpicker\IconPickerWidget::className()) ?>
                        
                        <?= $form->field($model, 'target')->textInput(['maxlength' => true]); ?>
                        
                        <?= $form->field($model, 'sort')->textInput(['maxlength' => true, 'type' => 'number', 'min' => 0, 'value' => 0]); ?>
                        
                        <?= $form->field($model, 'is_display')->radioList(Menu::loadDisplayOptions()); ?>
                        
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

