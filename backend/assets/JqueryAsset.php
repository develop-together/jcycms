<?php

namespace backend\assets;
use yii;

class JqueryAsset extends \yii\web\AssetBundle 
{
	public function init() 
	{
		parent::init();
		if (yii::$app->getRequest()->getBaseUrl() !== "") {
			$this->sourcePath = '@backend/web';
		}
	}

	public $css = [];

	public $js = [
		"static/js/jquery.min.js?v=2.1.4",
	];

	public $depends = [];
}
