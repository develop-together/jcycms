<?php

namespace backend\models;

use Yii;

class FriendLink extends \common\models\FriendLink
{
	public function getImageFormat()
	{
		return Yii::$app->request->baseUrl . '/' . $this->image;
	}
}