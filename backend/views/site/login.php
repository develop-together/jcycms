<?php

use backend\assets\AppAsset;
use yii\Captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->title = yii::t('app', 'Login');
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
        <style>
            div.form-group div.help-block {
                position: absolute;
                left: 305px;
                width: 170px;
                top: 4px;
                text-align: left;
            }

            .form-horizontal .form-group {
                width: 300px;
                margin-left: 0px;
            }

            img#loginform-captcha-image{
                position: absolute;
                top: 2px;
                right: 1px;
            }
        </style>
    </head>
    <body class="gray-bg">
        <?php $this->beginBody();?>
        <div class="middle-box text-center loginscreen  animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">H+</h1>
                </div>
                <h3><?=yii::t('app', 'Welcome to')?> JieChengYang CMS</h3>
                <?php $form = ActiveForm::begin(['id' => 'login-form']);?>
                    <?=$form->field($model, 'username', ['template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
->textInput(['autofocus' => true, 'placeholder' => yii::t("app", "Username")])?>

                    <?=$form->field($model, 'password', ['template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
->passwordInput(['placeholder' => yii::t("app", "Password")])?>
                    <div class="form-group field-loginform-password required">
                        <div style='position:relative'>
                            <input type="text" id="loginform-captcha" name="LoginForm[verifyCode]" style="width:300px;height:34px;position:relative;top:2px">
                           <!--验证码输出，调用Captcha类下的widget方法，需传入必要的配置信息，name属性必须要传入，captchaAction属性指定是哪个控制器下的哪个方法，site/captcha就是上文我们在SiteController的actions中定义的验证码
                           方法（其实在SiteCOntroller中的actions定义的，可以不添加该项，因为默认是SiteController，如果是在其他控制器中定义的，则必须添加该项）。imageOptions可以制定一些html标签属性属性，template指定模板，
                           这里只输出img标签，故只用了{image}-->
                           <?=Captcha::widget(['name' => 'captcha-img', 'captchaAction' => 'site/captcha', 'imageOptions' => ['id' => 'captcha-img', 'title' => '换一个', 'style' => 'cursor:pointer;position: absolute;top: 2px; right: 1px;'], 'template' => '{image}']);?>
                        </div>
                    </div>
                    <?=$form->field($model, 'rememberMe', ['template' => "<div style='position:relative'>{input}</div>"])->checkbox()?>
                    <?=Html::submitButton(yii::t("app", "Login"), [
	'class' => 'btn btn-primary block full-width m-b',
	'name' => 'login-button',
])?>
                <?php ActiveForm::end();?>
            </div>
        </div>
        <?php $this->endBody();?>
    </body>
<?php $this->endPage();?>
