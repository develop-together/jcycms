<?php

namespace frontend\themes\template1\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
	public $sourcePath = '@frontend/web/static/template1';

	public $css = [
		'a' => 'css/base.min.css',
		'b' => 'css/index.min.css',
		'c' => 'css/style.min.css',
		'd' => 'css/new.min.css',
	];

	public $js = [
		'a' => 'js/silder.min.js',
		'b' => ['js/modernizr.min.js', 'condition' => 'lte IE9']
	];

	public $depends = [
		'frontend\\assets\\FontsAsset',
		'frontend\\assets\\JqueryAsset',
		'frontend\\assets\\PjaxAsset',
		'frontend\\assets\\FlexTextAsset',
		'frontend\\assets\\CommentAsset',
		'frontend\\assets\\LayerAsset'
	];
}