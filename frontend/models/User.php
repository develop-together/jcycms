<?php 
 namespace frontend\models;

 use Yii;
 use common\models\User as commonUser;

 class User extends commonUser 
 {
	public static function tableName()
	{
		return '{{%user}}';
	}	

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => Yii::t('common', 'Username'),
			'password' => Yii::t('common', 'Password'),
			'status' => Yii::t('common', 'Status'),
			'last_login_ip' => yii::t('common', 'Last Login IP'),
			'login_count' => yii::t('common', 'Login Number'),
			'last_login_at' => yii::t('common', 'Last Login Time'),
			'created_at' => yii::t('common', 'Created At'),
			'updated_at' => yii::t('common', 'Updated At'),
		];
	}
 }