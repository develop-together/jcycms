<?php

use backend\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\components\BaseConfig;
use common\widgets\fileUploadInput\FileUploadInputWidget;

$this->title = Yii::t('app', 'Mall Manage Setting');
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
                    <?= Html::label(Yii::t('app', 'Linkman'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[linkman]', isset($config['linkman']) ? $config['linkman'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
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
                    <?= Html::label(Yii::t('app', 'Wechat'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[wechat]', isset($config['wechat']) ? $config['wechat'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'QQ'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[qq]', isset($config['qq']) ? $config['qq'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Base Addr'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[base_addr]', isset($config['base_addr']) ? $config['base_addr'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
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



