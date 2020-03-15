<?php

namespace backend\assets;

use yii;

class AppAsset extends \yii\web\AssetBundle 
{

	public function init() 
	{
		parent::init();
		if (yii::$app->getRequest()->getBaseUrl() !== "") {
			$this->sourcePath = '@backend/web';
		}
	}

	public $css = [
		'static/css/bootstrap.min.css?v=3.3.6',
		'static/css/font-awesome.min.css?v=4.4.0',
		'static/css/animate.min.css',
		'static/css/style.min.css?v=4.1.0',
		'static/css/plugins/sweetalert/sweetalert.css',
		'static/js/plugins/layer2.0/laydate/need/laydate.css',
		'static/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css',
		'static/css/plugins/toastr/toastr.min.css',
		'static/js/plugins/image-picker/image-picker.css',
		'static/css/my.style.css',
	];

	public $js = [
		'static/js/plugins/sweetalert/sweetalert.min.js',
		'static/js/plugins/layer2.0/laydate/laydate.js',
		'static/js/plugins/layer3.1.1/layer.js',
		'static/js/plugins/prettyfile/bootstrap-prettyfile.js',
		'static/js/plugins/toastr/toastr.min.js',
		'static/js/plugins/image-picker/image-picker.min.js',
		'static/js/jquery.backstretch.min.js',
		'static/js/jcy.min.js?v=1.0.2',
	];

	public $depends = [
		'yii\web\YiiAsset',
		'backend\assets\TypeaHeadAsset',
	];
}
