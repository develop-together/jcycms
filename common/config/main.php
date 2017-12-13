<?php
return [
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'language' => 'zh-CN', //默认语言
	'timeZone' => 'Asia/Shanghai', //默认时区
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
	],
];
