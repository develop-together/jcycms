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
                    'allowedIPs' => ['127.0.0.1', '::1'],
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
            'idParam' => '__backend__id',
            'returnUrlParam' => '_backend_returnUrl',
		],	
		// 'session' => [
		// 	// this is the name of the session cookie used for login on the backend
		// 	'name' => 'advanced-backend',
		// ],
		'log' => [//此项具体详细配置，请访问http://wiki.feehi.com/index.php?title=Yii2_log
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',//当触发levels配置的错误级别时，保存到日志文件
					'levels' => ['error', 'warning'],
				],
                [
                    'class' => yii\log\EmailTarget::className(),//当触发levels配置的错误级别时，发送到此些邮箱（请改成自己的邮箱）
                    'levels' => ['error', 'warning'],
                    /*'categories' => [//默认匹配所有分类。启用此项后，仅匹配数组中的分类信息会触发邮件提醒（白名单）
                        'yii\db\*',
                        'yii\web\HttpException:*',
                    ],*/
                    'except' => [//以下配置，除了匹配数组中的分类信息都会触发邮件提醒（黑名单）
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:403',
                        'yii\debug\Module::checkAccess',
                    ],
                    'message' => [
                        'to' => ['2064320087@qq.com'],
                        'subject' => '来自 JCY CMS 后台的新日志消息',
                    ],
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
	'on beforeRequest' => [common\components\BaseRequest::className(), 'backendInit'],
	'params' => $params,
];
