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
	'modules' => [
            'gii' => [
                    'class' => 'common\modules\gii\Module',
                    'allowedIPs' => ['127.0.0.1', '::1', 'localhost'],
                    'generators' => [
                        'crud' => [
                            'class' => 'yii\gii\generators\crud\Generator',
                            'templates' => [
                                'myCrud' => '@common/modules/gii/generators/crud/default',
                            ],
                        ],
                        'model' => [
                            'class' => 'yii\gii\generators\model\Generator',
                            'templates' => [
                                'myModel' => '@common/modules/gii/generators/model/default',
                            ],
                        ],
                        'form' => [
                            'class' => 'yii\gii\generators\form\Generator',
                            'templates' => [
                                'myForm' => '@common/modules/gii/generators/form/default',
                            ],
                        ],
                    ],
            ],
	],
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
	],
	'params' => $params,
];
