<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

class Comment extends \common\models\Comment
{

	public function scenarios()
	{
		return ArrayHelper::merge(parent::scenarios(), [
			'audit' => ['status']
		]);
	}
}