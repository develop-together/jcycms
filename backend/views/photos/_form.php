<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\widgets\Ueditor;
use common\models\Category;
use common\components\Utils;
use common\components\BaseConfig;
use common\widgets\fileUploadInput\FileUploadInputWidget;

$categoryTree = Utils::tree_bulid(Category::find()->asArray()->all(), 'id', 'parent_id');
$this->title = yii::t('app', 'Photos');

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
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'sub_title')->textInput(); ?>
                        <div class="hr-line-dashed"></div>
                        <?= $form->field($model, 'category_id')->dropDownList(Category::getDrowDownList($categoryTree), ['prompt' => '请选择', 'style' => 'width:200px']) ?>
                        <div class="hr-line-dashed"></div>
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
                        <div class="hr-line-dashed"></div>
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
                        <?= $form->field($model, 'photo_file_ids')->widget(FileUploadInputWidget::className(), [
                            'type' => 'feehi_imgs',
                            ]); ?>
                    </div>
                    <!--top stop --> 
                    <div class="hr-line-dashed"></div>
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