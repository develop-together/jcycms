<?php

namespace frontend\assets;

class CaptchaAsset extends \yii\web\AssetBundle {
	public $sourcePath = '@yii/assets';

	public $js = [
		'yii.captcha.js',
	];

	public $depends = [
		'frontend\assets\AppAsset',
	];
}