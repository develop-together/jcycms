<?php
$params = array_merge(
	require __DIR__ . '/../../common/config/params.php',
	require __DIR__ . '/../../common/config/params-local.php',
	require __DIR__ . '/params.php',
	require __DIR__ . '/params-local.php'
);

return [
	'id' => 'app-backend',
	'basePath' => dirname(__DIR__),
	'controllerNamespace' => 'backend\controllers',
	'language' => 'zh-CN', //默认语言
	'timeZone' => 'Asia/Shanghai', //默认时区
	'bootstrap' => ['log'],
	'modules' => [],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
		],
		'user' => [
			'identityClass' => 'backend\models\User',
			'enableAutoLogin' => true,
			'identityCookie' => ['name' => '_backend_identity'],
		],	
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'advanced-backend',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'request' => [
			'csrfParam' => '_csrf_backend',
		],
		'i18n' => [
			'translations' => [ //多语言包设置
				'app*' => [
					'class' => yii\i18n\PhpMessageSource::className(),
					'basePath' => '@backend/messages',
					'sourceLanguage' => 'en-US',
					'fileMap' => [
						'app' => 'app.php',
						'app/error' => 'error.php',
					],
				],
				'menu' => [
					'class' => yii\i18n\PhpMessageSource::className(),
					'basePath' => '@backend/messages',
					'sourceLanguage' => 'zh-CN',
					'fileMap' => [
						'app' => 'menu.php',
						'app/error' => 'error.php',
					],
				],
			],
		],
		/*
			        'urlManager' => [
			            'enablePrettyUrl' => true,
			            'showScriptName' => false,
			            'rules' => [
			            ],
			        ],
		*/
	],
	'params' => $params,
];
