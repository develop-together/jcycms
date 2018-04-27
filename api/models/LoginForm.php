<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\models;

use Yii;
use yii\base\Model;
use api\models\User;
use yii\web\UnauthorizedHttpException;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    private $_user;
    const GET_ACCESS_TOKEN = 'generate_access_token';
    public function init ()
    {
        parent::init();
        $this->on(self::GET_ACCESS_TOKEN, [$this, 'onGenerateAccessToken']);
    }
    /**
     * @inheritdoc
     * 对客户端表单数据进行验证的rule
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }
    /**
     * 自定义的密码认证方法
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_user = $this->getUser();
            if (!$this->_user || !$this->_user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误.');
                throw new UnauthorizedHttpException('用户名或密码错误');
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $this->trigger(self::GET_ACCESS_TOKEN);
            return $this->_user;
        } else {
            return null;
        }
    }

    /**
     * 刷新token
     * @param $token
     * @return User
     * @throws UnauthorizedHttpException
     */
    public function refreshToken($token) {
        $userRefreshToken = UserRefreshToken::findOne(['refresh_token' => $token, 'app_key' => Yii::$app->appClient->getAppKey()]);
        $expire = Yii::$app->params['user.refreshTokenExpire'];
        if ($userRefreshToken === null || ($userRefreshToken->created_at + $expire) < time()) {
            throw new UnauthorizedHttpException('Refresh token is invalid.');
        }
        $this->_user = $userRefreshToken->getUser();
        $this->trigger(self::GET_ACCESS_TOKEN);
        return $this->_user;
    }

    /**
     * 根据用户名获取用户的认证信息
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
    /**
     * 登录校验成功后，为用户生成新的token
     * 如果token失效，则重新生成token
     */
    public function onGenerateAccessToken()
    {
        UserAccessToken::deleteAll('user_id=:user_id AND app_key=:app_key',
            [':user_id' => $this->_user->id, ':app_key' => Yii::$app->appClient->getAppKey()]);
        $userAccessToken = new UserAccessToken();
        $userAccessToken->setAttributes([
            'user_id' => $this->_user->id,
            'app_key' => Yii::$app->appClient->getAppKey(),
            'access_token' => Yii::$app->appClient->getClient()->generateRandomString(32, false),
        ]);
        $userAccessToken->save();

        UserRefreshToken::deleteAll('user_id=:user_id AND app_key=:app_key',
            [':user_id' => $this->_user->id, ':app_key' => Yii::$app->appClient->getAppKey()]);
        $userRefreshToken = new UserRefreshToken();
        $userRefreshToken->setAttributes([
            'user_id' => $this->_user->id,
            'app_key' => Yii::$app->appClient->getAppKey(),
            'refresh_token' => Yii::$app->appClient->getClient()->generateRandomString(32, false),
        ]);
        $userRefreshToken->save();

//        if (!User::accessTokenIsValid($this->_user->access_token)) {
//            $this->_user->generateAccessToken();
//            $this->_user->save(false);
//        }
    }
}