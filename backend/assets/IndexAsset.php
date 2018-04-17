<?php
namespace backend\assets;
use yii;

class IndexAsset extends \yii\web\AssetBundle {
	public function init() {
		parent::init();
		if (yii::$app->getRequest()->getBaseUrl() !== "") {
			$this->sourcePath = '@backend/web';
		}
	}

	public $css = [
		'static/css/bootstrap.min.css',
		'static/css/font-awesome.min.css?v=4.4.0',
		'static/css/style.min.css?v=4.1.0',
	];

	public $js = [
		'static/js/jcy.js',
		"static/js/jquery.min.js?v=2.1.4",
		"static/js/bootstrap.min.js?v=3.3.6",
		"static/js/plugins/metisMenu/jquery.metisMenu.js",
		"static/js/plugins/slimscroll/jquery.slimscroll.min.js",
		"static/js/plugins/layer/layer.min.js",
		"static/js/hplus.min.js?v=4.1.0",
		"static/js/contabs.min.js",
		"static/js/plugins/pace/pace.min.js",
		'static/js/plugins/imgView/jquery-imgview.js',
	];

	public $depends = [
		'yii\web\YiiAsset',
		//'yii\bootstrap\BootstrapAsset',
		//'yii\bootstrap\BootstrapPluginAsset',
		//'jiecheng\assets\BootstrapAsset',
	];
}
