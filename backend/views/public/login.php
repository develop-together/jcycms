<?php

use backend\assets\AppAsset;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $this->beginPage();?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <?=Html::csrfMetaTags()?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head()?>
        <style type="text/css">
            ::-moz-selection { background: #4aaf51; color: #fff; text-shadow: none; }
            ::selection { background: #4aaf51; color: #fff; text-shadow: none; }
            .inner-bg {padding: 100px 0 170px 0;}
            .top-content .text {color: #fff;}
            .top-content .text h1 { color: #fff; }
            .top-content .description { margin: 20px 0 10px 0;}
            .top-content .description p { opacity: 0.8; }
            .top-content .description a {color: #fff;}
            .top-content .description a:hover, 
            .top-content .description a:focus { border-bottom: 1px dotted #fff; }
            .form-box {margin-top: 35px;}
            .form-top {overflow: hidden; padding: 0 25px 15px 25px;background: #fff;-moz-border-radius: 4px 4px 0 0; -webkit-border-radius: 4px 4px 0 0; border-radius: 4px 4px 0 0;text-align: left;}
            .form-top-left {float: left;width: 75%;padding-top: 25px;}
            .form-top-left h3 { margin-top: 0; }
            .form-top-right {float: left;width: 25%;padding-top: 5px;font-size: 66px;color: #ddd;line-height: 100px;text-align: right;}
            .form-bottom {padding: 25px 25px 30px 25px;background: #eee;-moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;text-align: left;}
            .form-bottom form textarea {height: 100px;}
            .form-bottom form button.btn {width: 100%; }
            .form-bottom form .input-error {border-color: #4aaf51;}
            @media (max-width: 767px) {.inner-bg { padding: 60px 0 110px 0; }}
        </style>
    </head>
    <body>
        <?php $this->beginBody();?>
        <div class="top-content">          
            <div class="inner-bg">
                <?= $this->render('../widgets/_flash') ?> 
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text text-center">
                            <h1><strong>JCYCMS</strong> 系统</h1>
                            <div class="description">
                                <p>
                                    欢迎您的到来<br>我们是开源的哦！
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>登录到我们的站点</h3>
                                    <p>输入您的用户名和密码登录：</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => [
                                        'class' => 'login-form',
                                    ]]);?>
                                    <?= $form->field($model, 'username', 
                                        ['template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
                                            ->textInput([
                                                'autofocus' => true, 
                                                'placeholder' => Yii::t("app", "Username"),
                                                'class' => 'form-username form-control'
                                            ])
                                    ?>

                                    <?= $form->field($model, 'password', [
                                        'template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
                                            ->passwordInput([
                                                'placeholder' => Yii::t("app", "Password"),
                                                 'class' => 'form-password form-control'
                                            ])
                                    ?>

                                    <?= $form->field($model, 'verifyCode', [
                                        'template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
                                        ->widget(Captcha::className(), [
                                        'captchaAction' => 'public/captcha',
                                        'imageOptions' => ['alt' => '点击换图', 'title' => '点击换图', 'style' => 'cursor:pointer;position: absolute;top: 2px; right: 1px;'],
                                        'options' => ['class' => 'form-control', 'style' => "height:34px;position:relative;top:2px"],
                                        'template' => '{input}{image}',
                                    ]) ?>
    
                                    <?= $form->field($model, 'rememberMe', ['template' => "<div style='position:relative' class='text-center'>{input}</div>"])->checkbox()?>
                                    <?= Html::submitButton(Yii::t("app", "Login"), [
                                    'class' => 'btn btn-primary',
                                    'name' => 'login-button',
                                    ])?>
                                <?php ActiveForm::end();?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody();?>
        <?php 
            $jsStr = <<<JS
                $.backstretch("/static/img/login_bg_1.jpg");
JS;
            $this->registerJs($jsStr);
         ?>
    </body>
<?php $this->endPage();?>
