<?php 
 namespace frontend\models;

 use Yii;
 use yii\helpers\ArrayHelper;
 use common\components\Utils;
 use common\models\LoginForm as CommonLoginForm;

 class LoginForm extends CommonLoginForm
 {
	public function login() {
		if (parent::login()) {
	        $this->user->updateAttributes([
	        	'last_login_ip' => Utils::getClientIP(),
	        	'last_login_at' => time(),
	        	'login_count' => $this->user->login_count + 1
	        ]);	

	        return true;
		}

		return false;
	}
 }