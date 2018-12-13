<?php 

namespace frontend\themes\template2\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle 
{
	public $sourcePath = '@frontend/web/static/template2';

	public $css = [
		'a' => 'css/base.css',
		'b' => 'css/index.css',
		'c' => 'css/m.css',
	];

	public $js = [
		'a' => ['js/modernizr.js', 'condition' => 'lte IE9'],
	];
}