<?php

namespace common\models;

use Yii;

use yii\db\ActiveQuery;

class FrontendMenuQuery extends ActiveQuery
{
	public function init()
	{
		$this->andOnCondition(['type' => Menu::MENU_TYPE_FRONTEND]);

		parent::init();
	}

	public function show($isDisplay = 1)
	{
		return $this->andOnCondition(['is_display' => $isDisplay]);
	}
}