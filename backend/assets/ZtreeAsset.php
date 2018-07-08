<?php

namespace backend\assets;
use yii;

class ZtreeAsset extends \yii\web\AssetBundle 
{
	public function init() 
	{
		parent::init();
		if (yii::$app->getRequest()->getBaseUrl() !== "") {
			$this->sourcePath = '@backend/web';
		}
	}

	public $css = [
		'static/js/plugins/ztree/css/zTreeStyle/zTreeStyle.css',
	];

	public $js = [
		'static/js/plugins/ztree/js/jquery.ztree.all.js',
	];

	public $depends = [
		'backend\assets\appAsset',
	];
}
