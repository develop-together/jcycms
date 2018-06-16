<?php

namespace frontend\assets;

class BootstrapAsset extends \yii\bootstrap\BootstrapAsset {

	public $js = [
		'js/bootstrap.min.js',
	];

	public $depends = [
		// 'frontend\assets\AppAsset',
	];
}