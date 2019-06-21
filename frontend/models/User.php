<?php
 namespace frontend\models;

 use Yii;
 use yii\helpers\Json;
 use common\components\Utils;
 use common\models\User as commonUser;

 class User extends commonUser
 {
	public function beforeSave($insert) {
		if (!$insert) {
			$this->avatar = $this->uploadOpreate('avatar', '@backend/web/uploads/user-avatar/' . date('Ymd') . '/', 'Image');
		}

		return parent::beforeSave($insert);
	}
 }