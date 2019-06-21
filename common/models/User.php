<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use common\components\BaseModel;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends BaseModel implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const AUTH_KEY = '666666';

    public $password;
    public $repeat_pwd;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'repeat_pwd', 'password_hash', 'avatar'], 'string'],
            [['username', 'email'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['email', 'email'],
            [['repeat_pwd'], 'compare', 'compareAttribute' => 'password'],
            [['username', 'email', 'password', 'repeat_pwd'], 'required', 'on' => ['create']],
            [['username', 'email'], 'required', 'on' => ['update']],
            // [['avatar'], 'avatar', 'enableClientValidation' => true,   'maxSize' => 1024, 'message' => '您上传的文件过大'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['username', 'password', 'avatar', 'email', 'status', 'password', 'repeat_pwd'],
            'update' => ['username', 'password', 'avatar', 'email', 'status', 'password', 'repeat_pwd'],
            'self-update' => [],
            'avatar-setting' => ['avatar']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => Yii::t('common', 'Username'),
            'password' => yii::t('common', 'Password'),
            'repeat_pwd' => yii::t('common', 'Duplicate Password'),
            'email' => Yii::t('common', 'Email'),
            'avatar' => Yii::t('common', 'Avatar'),
            'status' => Yii::t('common', 'Status'),
            'last_login_ip' => yii::t('common', 'Last Login IP'),
            'login_count' => yii::t('common', 'Login Number'),
            'last_login_at' => yii::t('common', 'Last Login Time'),
            'created_at' => yii::t('common', 'Created At'),
            'updated_at' => yii::t('common', 'Updated At'),
        ];
    }

    public function getAvatarFormat()
    {
        return $this->avatar ? Yii::$app->request->baseUrl . '/' . $this->avatar : '/staic/common/face.jpg';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function beforeSave($insert)
    {
        if (!$insert && !empty($this->password)) {
            $this->generateAuthKey();
            $this->setPassword($this->password);          
        } else if ($insert) {
            $this->generateAuthKey();
            $this->setPassword($this->password);    
        }

        return parent::beforeSave($insert);

    }

    public static function loadStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => '正常',
            self::STATUS_DELETED => '禁用',
        ];
    }

    public function getStatusFormat()
    {
        return self::loadStatusOptions()[$this->status];
    }

    public function getLoginAddress()
    {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $this->last_login_ip;
        $ip = Json::decode(file_get_contents($url), true);
        if (!$ip['data']['region']) {
            return $this->last_login_ip;
        } else {
            return $ip['data']['country'] . '.' . $ip['data']['region'] . '.' . $ip['data']['city'];
        }
    }
}
