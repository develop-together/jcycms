<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-03-15 21:16
 */

/**
 * @var $this yii\web\View
 * @var $model \common\models\LoginForm
 */

use api\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
$this->title = yii::t('app', 'Login');

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="renderer" content="webkit">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
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

            .form-control {
                margin-bottom: 20px;
            }

            .main {
                width: 300px;
                margin: 0px auto;
            }

            .full-width {
                width: 100%;
            }
        </style>
    </head>
    <body class="gray-bg">
    <?php $this->beginBody() ?>
    <div class="main text-center">
        <div>
            <div>
                <h1 class="logo-name"><img src=""></h1>
            </div>
            <h3><?= yii::t('app', 'Welcome to') ?></h3>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            
            <?= $form->field($model, 'username', ['template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
                ->textInput(['autofocus' => true, 'placeholder' => yii::t("app", "Username")]) ?>

            <?= $form->field($model, 'password', ['template' => "<div style='position:relative'>{input}\n{error}\n{hint}</div>"])
                ->passwordInput(['placeholder' => yii::t("app", "Password")]) ?>

            <?= Html::submitButton(yii::t("app", "Login"), [
                'class' => 'btn btn-primary full-width',
                'name' => 'login-button'
            ]) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>