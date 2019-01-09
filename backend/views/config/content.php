<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\components\BaseConfig;

$this->title = Yii::t('app', 'Content Setting');

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
                            'options' => ['class' => 'form-horizontal'],
                ]); ?>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Clipping Article Image'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::radioList('Config[clipping_img]', isset($config['clipping_img']) ? $config['clipping_img'] : null, BaseConfig::getYesNoItems())?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'watermark'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::radioList('Config[watermark_img]', isset($config['watermark_img']) ? $config['watermark_img'] : null, BaseConfig::getYesNoItems())?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'watermark location'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::radioList('Config[watermark_location]', isset($config['watermark_location']) ? $config['watermark_location'] : null, BaseConfig::getWatermarkLocation())?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Open Comment'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::radioList('Config[open_comment]', isset($config['open_comment']) ? $config['open_comment'] : null, BaseConfig::getYesNoItems())?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Open Comment Verify'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::radioList('Config[open_comment_verify]', isset($config['open_comment_verify']) ? $config['open_comment_verify'] : null, BaseConfig::getYesNoItems())?>
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