<?php
 namespace frontend\models;

 use Yii;
 use yii\helpers\Json;
 use common\components\Utils;
 use common\models\User as commonUser;

 class User extends commonUser
 {
 	public $password;
 	public $repeat_pwd;

	public static function tableName()
	{
		return '{{%user}}';
	}

	public function rules()
	{
		return [
            [['username', 'password', 'repeat_pwd', 'password_hash', 'avatar'], 'string'],
            // [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            [['repeat_pwd'], 'compare', 'compareAttribute' => 'password'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'email', 'password', 'repeat_pwd'], 'required', 'on' => ['create']],
            [['username', 'email'], 'required', 'on' => ['update']],
		];
	}

	public function scenarios()
	{
		return [
			'create' => ['username', 'password', 'avatar', 'email', 'status', 'password', 'repeat_pwd'],
			'update' => ['username', 'password', 'avatar', 'email', 'status', 'password', 'repeat_pwd'],
			'self-update' => [],
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
		return $this->avatar ? $this->avatar : '/staic/common/face.jpg';
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