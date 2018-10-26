<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\components\Utils;

/**
 * Login form
 */
class LoginForm extends Model {
	public $username;
	public $password;
	public $rememberMe = true;
	public $verifyCode; //验证码这个变量是必须建的，因为要储存验证码的值` /** * @return array the validation rules. */
	private $_user;

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			// username and password are both required
			[['username', 'password'], 'required'],
			// rememberMe must be a boolean value
			['rememberMe', 'boolean'],
			// password is validated by validatePassword()
			['password', 'validatePassword'],
			[
				'verifyCode',
				'captcha',
				'captchaAction' => 'public/captcha',
				'message' => Yii::t('app', 'Verification code error.'),
			],
			///注意这里，在百度中查到很多教程，这里写的都不一样，最 简单的写法就像我这种写法，当然还有其它各种写法
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function validatePassword($attribute, $params) {
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, Yii::t('app', 'Incorrect username or password.'));
			}
		}
	}

	/**
	 * Logs in a user using the provided username and password.
	 *
	 * @return bool whether the user is logged in successfully
	 */
	public function login() {
		if ($this->validate()) {
			
			$loginResult = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
			if ($loginResult) {
		        $this->user->updateAttributes([
		        	'last_login_ip' => Utils::getClientIP(),
		        	'last_login_at' => time(),
		        	'login_count' => $this->user->login_count + 1
		        ]);				
			}

			return $loginResult;
		}

		return false;
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	protected function getUser() {
		if ($this->_user === null) {
			$this->_user = User::findByUsername($this->username);
		}

		return $this->_user;
	}

	public function attributeLabels() {
		return [
			'username' => Yii::t('app', 'Username'),
			'password' => Yii::t('app', 'Password'),
			'rememberMe' => Yii::t('app', 'rememberMe'),
			'verifyCode' => Yii::t('app', 'Captcha'),
		];
	}
}
