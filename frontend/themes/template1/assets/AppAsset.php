<?php

namespace frontend\themes\template1\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
	public $sourcePath = '@frontend/web/static/template1';

	public $css = [
		'a' => 'css/base.css',
		'b' => 'css/index.css',
		'c' => 'css/style.css',
		'd' => 'css/new.css',
	];

	public $js = [
		'a' => 'js/silder.js',
		'b' => ['js/modernizr.js', 'condition' => 'lte IE9']
	];

	public $depends = [
		'frontend\\assets\\FontsAsset',
		// 'frontend\\assets\\JqueryAsset',
		'frontend\\assets\\PjaxAsset',
		'frontend\\assets\\FlexTextAsset',
		'frontend\\assets\\CommentAsset'
	];
}