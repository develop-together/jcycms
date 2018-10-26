<?php

namespace backend\assets;
use yii;

class BootstrapAsset extends \yii\web\AssetBundle 
{
	public function init() 
	{
		parent::init();
		if (yii::$app->getRequest()->getBaseUrl() !== "") {
			$this->sourcePath = '@backend/web';
		}
	}

	public $css = ['static/css/bootstrap.min.css'];

	public $js = [
		"static/js/bootstrap.min.js?v=3.3.6",
	];

	public $depends = [
		'backend\assets\JqueryAsset'
	];
}
