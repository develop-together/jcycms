<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repeat_pwd;
    public $verifyCode;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username', 'email', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common', 'This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('common', 'This email address has already been taken.')],
            [['password', 'repeat_pwd'], 'string', 'min' => 6],
            [['repeat_pwd'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('common', 'The value of the repeated password must be equal to the "password".')],
            ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha', 'message' => Yii::t('common', 'Verification code error.')]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'username' => Yii::t('common', 'User'),
            'password' => Yii::t('common', 'Password'),
            'email' => Yii::t('common', 'Email'),
            'repeat_pwd' => Yii::t('common', 'Duplicate Password'),
            'verifyCode' => yii::t('common', 'Verify Code'),
        ];        
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
