<?php

namespace common\models;

use Yii;

class FrontendMenu extends Menu
{
	public static function find()
	{
		 return new FrontendMenuQuery(get_called_class());
	}
}