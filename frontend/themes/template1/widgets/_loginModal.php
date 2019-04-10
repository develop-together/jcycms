<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
	use frontend\models\LoginForm;

    $loginModel = new LoginForm();
 ?>
<div class="modal fade in" id="loginModal" style="display: none;">
	<div style="display:table; width:100%; height:100%;">
		<div style="vertical-align:middle; display:table-cell;">
			<div class="modal-dialog modal-sm" style="width:540px;">
				<div class="modal-content" style="border:none;">
					<div class="col-left"></div>
					<div class="col-right">
						<div class="modal-header">
							<button type="button" id="login_close" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title" id="loginModalLabel" style="font-size: 18px;">登录</h4>
						</div>
						<div class="modal-body">
							<section class="box-login v5-input-txt" id="box-login">
				                <?php
				                    $loginForm = ActiveForm::begin([
				                        'id' => 'login-form',
				                        'enableClientValidation' => false,
				                        'action' => Url::toRoute(['site/login']),
				                        'options' => ['autocomplete' => 'off'],
				                        'fieldConfig' => [
				                        	'template' =>"<li class='form-group'>{input}</li>",
				                        ]
				                    ]);
				                ?>
					                <ul>
										<?= $loginForm->field($loginModel, 'username')->textInput(['maxlength' => 50, 'autofocus' => true, 'placeholder' => '请输入用户名']) ?>
										<?= $loginForm->field($loginModel, 'password')->passwordInput(['placeholder' => '请输入用户名']) ?>
					                </ul>
				                <?php ActiveForm::end(); ?>
								<p class="good-tips marginB10"><a id="btnForgetpsw" class="fr">忘记密码？</a>还没有账号？<a href="<?= Url::to(['site/signup']) ?>" target="_blank" id="btnRegister">立即注册</a></p>
								<div class="login-box marginB10">
									<button id="login_btn" type="button" class="btn btn-micv5 btn-block globalLogin">登录</button>
									<div id="login-form-tips" class="tips-error bg-danger" style="display: none;">错误提示</div>
								</div>


								<div class="threeLogin"><span>其他方式登录</span><a class="nqq" href="javascript:;"></a><a class="nwx" href="javascript:;"></a><!--<a class="nwb"></a>--></div>

							</section>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal-backdrop fade " style="display: none;"></div>