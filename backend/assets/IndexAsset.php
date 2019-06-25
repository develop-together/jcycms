<?php

namespace backend\assets;
use yii;

class IndexAsset extends \yii\web\AssetBundle 
{
	public function init() 
	{
		parent::init();
		if (yii::$app->getRequest()->getBaseUrl() !== "") {
			$this->sourcePath = '@backend/web';
		}
	}

	public $css = [
		'static/css/font-awesome.min.css?v=4.4.0',
		'static/css/style.min.css?v=4.1.0',
	];

	public $js = [
		"static/js/plugins/metisMenu/jquery.metisMenu.js",
		"static/js/plugins/slimscroll/jquery.slimscroll.min.js",
		"static/js/plugins/layer2.0/layer.min.js",
		"static/js/hplus.min.js?v=4.1.0",
		"static/js/contabs.all.js",
		"static/js/plugins/pace/pace.min.js",
		'static/js/plugins/imgView/jquery-imgview.js',
		'static/js/jcy.min.js',
	];

	public $depends = [
		'backend\assets\YiiAsset',
		'backend\assets\BootstrapAsset',
	];
}
