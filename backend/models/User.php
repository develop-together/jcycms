<?php
namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use common\components\BaseModel;
use common\components\UserAcl;
use yii\web\ForbiddenHttpException;
//use AdminRoleUser;
use yii\web\IdentityInterface;

class User extends BaseModel implements IdentityInterface 
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	const SUPER_MANAGER = 1;
	const AUTH_KEY = '123456';

	public $password;

	public $repeat_pwd;

	public $old_pwd;

	/**
	 * 返回数据表名
	 *
	 * @return string
	 */
	public static function tableName() 
	{
		return '{{%admin_user}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() 
	{
		return [
			[['username', 'auth_key', 'avatar', 'password', 'repeat_pwd', 'password_hash'], 'string'],
			['email', 'email'],
			['email', 'unique'],
			[['repeat_pwd'], 'compare', 'compareAttribute' => 'password'],
			//[['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, webp'],
			[['status'], 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
			[['username', 'email', 'password', 'avatar'], 'required', 'on' => ['create']],
			[['email', 'avatar'], 'required', 'on' => ['updateSelf']],
			// [['password'], 'checkOldAttribute','skipOnError' => false, 'skipOnEmpty' => false],
		];
	}

/*	public function checkOldAttribute($attribute, $params)
	{
		if (!$this->hasError()) {
			if($this->$attribute != $this->getOldAttribute('password')) {
				$this->addError('password', Yii::t('app', 'The Old Password Is Error'));
			}
		}
	}*/

	public function scenarios()
	{
		$parentScenarios = parent::scenarios();
		return array_merge($parentScenarios, [
			'default' => ['username', 'email'],
			'create' => ['username', 'email', 'password', 'avatar', 'status'],
			'update' => ['username', 'email', 'password', 'avatar', 'status'],
			'updateSelf' => ['avatar', 'email', 'password'],
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() 
	{
		return [
			'username' => yii::t('app', 'Username'),
			'email' => yii::t('app', 'Email'),
			'old_pwd' => yii::t('app', 'Old Password'),
			'password' => yii::t('app', 'Password'),
			'repeat_pwd' => yii::t('app', 'Repeat Password'),
			'avatar' => yii::t('app', 'Avatar'),
			'status' => yii::t('app', 'Status'),
			'created_at' => yii::t('app', 'Created At'),
			'updated_at' => yii::t('app', 'Updated At'),
		];
	}

	public static function getStatuses() 
	{
		return [
			self::STATUS_ACTIVE => yii::t('app', 'Normal'),
			self::STATUS_DELETED => yii::t('app', 'Disabled'),
		];
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
	 * @return boolean
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
	 * @return boolean if password provided is valid for current user
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

	public function signUp() 
	{
		if (!$this->validate()) {
			return false;
		}
		$this->password = $this->password == null ? $this->getModule()->defaultPassword : $this->password;
		$this->setPassword($this->password);
		$this->generateAuthKey();
		if (!$this->save()) {
			return false;
		}

		return true;
	}

	public static function loadStatusOptions()
	{
		return [
				self::STATUS_ACTIVE => Yii::t('app', 'Normal'),
				self::STATUS_DELETED => Yii::t('app', 'Disabled'),
		];
	}

	public static function checkSuperManager()
	{
		return AdminRoleUser::find()->where(['user_id' => Yii::$app->user->id, 'role_id' => AdminRoles::SUPER_ROLE_ID]);
	}

	public function getStatusFormat()
	{
		$arr = self::loadStatusOptions();

		if (isset($this->status)) {
			return $arr[$this->status];
		}

		return $this->status;
	}

	public function getAvatarFormat()
	{
		if ($this->avatar) {
			if(strpos($this->avatar, Yii::$app->params['uploadSaveFilePath']) !== false) {
				return Yii::$app->request->baseUrl  . '/' . $this->avatar;				
			}

			return Yii::$app->request->baseUrl . '/' . Yii::$app->params['uploadSaveFilePath'] . '/' . $this->avatar;
		}

		return Yii::$app->request->baseUrl . '/static/img/noface.png';
	}

	public function beforeSave($insert)
	{
		if (!$insert) {
			$this->password = $this->password ? $this->password : self::AUTH_KEY;
		}
		
		$this->generateAuthKey();
		$this->setPassword($this->password);
		return parent::beforeSave($insert);

	}

	public function beforeDelete() {
		if (self::checkSuperManager()) {
			throw new ForbiddenHttpException(yii::t('app', "Not allowed to delete {attribute}", ['attribute' => yii::t('app', 'default super administrator admin')]));
		}
		return true;
	}

	//关联角色[本系统目前仅支持一个用户对应一个角色]
	public function getUserRole()
	{
		return $this->hasOne(AdminRoleUser::className(), ['user_id' => 'id']);
	}

    /**
     * 判断用户是否拥有某个权限
     * @param  string  $acl 权限名
     * @return boolean  
     */
    public function hasAcl($acl='')
    {
        $route = explode('/', $acl);
        $action = count($route) - 1;
        // 特殊权限处理
        if ($route[$action] == 'view') {
            $route[$action] = 'index';
            $acl = implode('/', $route);
        }

        return in_array($acl, $this->aclList);
    }

	public function getAclList()
	{
        $publicAclList = UserAcl::publicAclList();
        $roleAclListModels = @$this->userRole->getRoleAclLists();
        $roleAclLists = $roleAclListModels->all();
        $aclLists = [];
        if ($roleAclLists) {
        	foreach ($roleAclLists as $list) {
        		$aclLists[] = $list->menu ? $list->menu->url : '';
        	}
        }

        return array_merge($publicAclList, $aclLists);		
	}
}
