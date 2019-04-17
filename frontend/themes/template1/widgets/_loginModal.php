<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
	use frontend\models\LoginForm;

    $loginModel = new LoginForm();
 ?>
 <style type="text/css">
 	.error-info {
		color: red;
 	}
 </style>
<div class="modal fade in" id="loginModal" style="display: none;">
	<div style="display:table; width:100%; height:100%;">
		<div style="vertical-align:middle; display:table-cell;">
			<div class="modal-dialog modal-sm" style="width:540px;">
				<div class="modal-content" style="border:none;">
					<div class="col-left"></div>
					<div class="col-right">
						<div class="modal-header">
							<button type="button" id="login_close" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="loginModalLabel" style="font-size: 18px;"><?= Yii::t('frontend', 'Login') ?></h4>
						</div>
						<div class="modal-body">
							<section class="box-login v5-input-txt" id="box-login">
				                <?php
				                    $loginForm = ActiveForm::begin([
				                        'id' => 'login-form',
				                        'enableClientScript' => false,
				                        'enableClientValidation' => false,
				                        'action' => Url::toRoute(['site/ajax-login']),
				                        'options' => ['autocomplete' => 'off'],
				                        'fieldConfig' => [
				                        	'template' =>"{input}<div class='error-info'></div>",
				                        ]
				                    ]);
				                ?>
									<?= $loginForm->field($loginModel, 'username')->textInput(['maxlength' => 50, 'autofocus' => true, 'placeholder' => Yii::t('frontend', 'Please Input username')]) ?>
									<?= $loginForm->field($loginModel, 'password')->passwordInput(['placeholder' => Yii::t('frontend', 'Please Input password')]) ?>
				                <?php ActiveForm::end(); ?>
								<p class="good-tips marginB10"><a id="btnForgetpsw" class="fr"><?= Yii::t('frontend', 'forgot password?')?></a><?= Yii::t('frontend', 'No account yet') ?><a href="<?= Url::to(['site/signup']) ?>" target="_blank" id="btnRegister"><?= Yii::t('frontend', 'I sign up')?></a></p>
								<div class="login-box marginB10">
									<button id="login_btn" type="button" class="btn btn-micv5 btn-block globalLogin"><?= Yii::t('frontend', 'Login') ?></button>
									<div id="login-form-tips" class="tips-error bg-danger" style="display: none;"><?= Yii::t('frontend', 'Error') ?></div>
								</div>
								<div class="threeLogin"><span><?= Yii::t('frontend', 'Other ways to log in') ?></span><a class="nqq" href="javascript:;"></a><a class="nwx" href="javascript:;"></a><!--<a class="nwb"></a>--></div>
							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-backdrop fade " style="display: none;"></div>
<?php
	$tips = Yii::t('frontend', 'Please Input') . Yii::t('frontend', 'Username');
	$tips2 = Yii::t('frontend', 'Please Input') . Yii::t('frontend', 'Password');
	$this->registerJs(<<<JSBLOCK
			$("#login_btn").on('click', function(){
				var username = $("#loginform-username").val();
				if (username === '' || username === null || username === 'undefined') {
					// alert("$tips");
					$("#loginform-username").parent('div').children('.error-info').html("$tips");
					$("#loginform-username").focus();
					return false;
				} else {
					$("#loginform-username").parent('div').children('.error-info').html("");
				}
				var password = $("#loginform-password").val();
				if (password === '' || password === null || password === 'undefined') {
					// alert("$tips2");
					$("#loginform-password").parent('div').children('.error-info').html("$tips2");
					$("#loginform-password").focus();
					return false;
				} else {
					$("#loginform-password").parent('div').children('.error-info').html("");
				}
				// $("#login-form").submit();
				var csrfToken = $("meta[name=\"csrf-token\"]").attr('content');
				var params = {
					username: username,
					password: password
				}
				$.ajax({
					type: 'POST',
					url: $("#login-form").attr('action'),
					data: {LoginForm: params, _csrf_frontend: csrfToken},
					dataType: 'JSON',
					success: function (res) {
						if(res.code !== 10010) {
							layer.msg(res.message, {icon: 5});
							$("#loginform-password").val('')
						} else {
							window.location.reload();
						}
					}
				})
			})
JSBLOCK
);
 ?>