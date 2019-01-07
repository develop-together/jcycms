<?php

use backend\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\components\BaseConfig;
use common\widgets\fileUploadInput\FileUploadInputWidget;

$this->title = Yii::t('app', 'Website Setting');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><?= $this->title ?></h5>
            </div>
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
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'System Name'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[system_name]', isset($config['system_name']) ? $config['system_name'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Company Name'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[company_name]', isset($config['company_name']) ? $config['company_name'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Company Url'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[company_url]', isset($config['company_url']) ? $config['company_url'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Tel'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[tel]', isset($config['tel']) ? $config['tel'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Email'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[email]', isset($config['email']) ? $config['email'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'System Description'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textarea('Config[system_notes]', isset($config['system_notes']) ? $config['system_notes'] : '', ['class' => 'form-control', 'rows' => 5, 'cols' => 60]) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Seo Keyword'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[seo_keyword]', isset($config['seo_keyword']) ? $config['seo_keyword'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Seo Description'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textarea('Config[seo_description]', isset($config['seo_description']) ? $config['seo_description'] : '', ['class' => 'form-control', 'rows' => 5, 'cols' => 60]) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Internal address external access'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::radioList('Config[deny_external_access]', isset($config['deny_external_access']) ? $config['deny_external_access'] : null, BaseConfig::getYesNoItems())?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Web Templates'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::imagePicker('Config[web_templates]',
                            isset($config['web_templates']) ? $config['web_templates'] : null,
                            BaseConfig::getWebTemplateItems(),
                            ['class' => 'form-control', 'style' => 'width:120px;', 'id' => 'Config_web_templates'],
                            BaseConfig::getDataImgSrc()
                        )?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <?= $form->field($logo, 'system_logo')->widget(FileUploadInputWidget::className(),[
                    'type' => 'image'
                ]); ?>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <?= Html::submitButton(Yii::t('app', 'Save') , ['class' => 'btn btn-success']) ?>

                        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>
                    </div>
                </div>
                <?php  BAF::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
    $this->registerJs(<<<JS
        $('#Config_web_templates').imagepicker({
            hide_select : true,
            show_label : true
        });
JS
    );
 ?>


