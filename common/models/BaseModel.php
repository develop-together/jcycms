<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;

/**
 * base model
 */
class BaseModel extends \yii\db\ActiveRecord {
	public function behaviors() {
		$behaviors = [];
		if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
			$behaviors[] = TimestampBehavior::className();
		}
		return $behaviors;
	}

}