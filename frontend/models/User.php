<?php 
 namespace frontend\models;

 use common\models\User as commonUser;

 class User extends commonUser 
 {
	public static function tableName()
	{
		return '{{%user}}';
	}	

	public function attributeLabel()
	{
		return [
			'username' => yii::t('common', 'Username'),
			'password' => yii::t('common', 'Password'),
			'rememberMe' => yii::t('common', 'rememberMe'),
		];
	}
 }