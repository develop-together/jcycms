<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\widgets\Ueditor;
use common\models\Category;
use common\components\Utils;
use common\components\BaseConfig;
use common\widgets\fileUploadInput\FileUploadInputWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
$categoryTree = Utils::tree_bulid(Category::find()->asArray()->all(), 'id', 'parent_id');
$this->title = yii::t('app', 'Articles');

?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content">
                <div class="row">
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
                    <!--top start-->
                    <div class=" " style="">
                        <?= $form->field($model, 'title')->textInput(); ?>
                        <?= $form->field($model, 'sub_title')->textInput(); ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= yii::t('app', 'Seo Setting') ?>:</label>
                            <div class="col-sm-10">
                                <?= $form->field($model, 'seo_title', [                                    
                                    'labelOptions' => ['class' => 'col-sm-3']
                                ])->textInput(); ?>
                                <?= $form->field($model, 'seo_keywords', [                                    
                                    'labelOptions' => ['class' => 'col-sm-3']
                                ])->textInput(); ?>
                                <?= $form->field($model, 'seo_description', [                                    
                                    'labelOptions' => ['class' => 'col-sm-3']
                                ])->textInput(); ?>                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><?= yii::t('app', 'Other') ?>:</label>
                            <div class="col-sm-10">
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'status', [
                                       
                                        'labelOptions' => ['class' => 'col-sm-5 control-label']
                                    ])->dropDownList(BaseConfig::getArticleStatus()); ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'can_comment', [
                                       
                                        'labelOptions' => ['class' => 'col-sm-5 control-label']
                                    ])->dropDownList(BaseConfig::getYesNoItems()); ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'visibility', [
                                       
                                        'labelOptions' => ['class' => 'col-sm-5 control-label']
                                    ])->dropDownList(BaseConfig::getArticleVisibility()); ?>
                                </div>                                
                            </div>
                        </div>
                        <?= $form->field($model, 'content')->widget(Ueditor::className()) ?>
                    </div>
                    <!--top stop --> 
                    <div class="form-group text-right">
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
</div>