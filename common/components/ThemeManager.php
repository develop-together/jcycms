<?php 

namespace common\components;

use yii\base\Theme;

class ThemeManager extends Theme
{
	public function init()
	{
		$this->pathMap = [
			'@app/views' => BaseConfig::loadThemes()
		];

		parent::init();
	}
}