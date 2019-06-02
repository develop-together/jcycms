<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm AS BAF;
use common\components\BaseConfig;
use common\widgets\fileUploadInput\FileUploadInputWidget;

$this->title = Yii::t('app', 'SMTP Setting');
$uniqid = Yii::$app->controller->_uniqid;

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
                    <?= Html::label(Yii::t('app', 'SMTP Host'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[smtp_server]', isset($config['smtp_server']) ? $config['smtp_server'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'SMTP Port'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[smtp_port]', isset($config['smtp_port']) ? $config['smtp_port'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Sender'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[smtp_sender]', isset($config['smtp_sender']) ? $config['smtp_sender'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'SMTP Username'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('Config[smtp_user]', isset($config['smtp_user']) ? $config['smtp_user'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'SMTP Password'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::passwordInput('Config[smtp_password]', isset($config['smtp_password']) ? $config['smtp_password'] : '', ['class' => 'form-control', 'style' => 'width:40%']) ?>
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Send Test'), null, ['class' => 'col-sm-2 control-label']) ?>
                    <div class="col-sm-10">
                        <?= Html::textInput('test_email',  '', [
                            'id' => 'test_email_input_' . $uniqid,
                            'class' => 'form-control',
                            'style' => 'width:40%;display:inline',
                            'placeholder' => Yii::t('app', 'Fill In The Mail Box'),
                        ]) ?>

                        <?= Html::button('<i class="fa fa-send"></i> ' . Yii::t('app', 'Send'), [
                            'id' => 'email-test-btn-' . $uniqid,
                            'class' => 'btn btn-primary',
                        ]) ?>
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

<?php
    $testurl = Url::toRoute(['config/test-email']);
    $this->registerJs(<<<EOT
        $("#email-test-btn-$uniqid").on('click', function(){
            layer.load();
            jcms.ajax('GET', "$testurl", {email: $("#test_email_input_$uniqid").val()}, 'JSON', function(response){
                jcms.callback(response.message, response.statusCode, true);
            }, false, 1000);
        });
EOT
);
 ?>


