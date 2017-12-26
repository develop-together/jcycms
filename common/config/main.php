<?php
return [
    'name' => 'Jcy CMS',
    'version' => '0.0.1',
	'aliases' => [
		'@bower' => '@vendor/bower-asset',
		'@npm' => '@vendor/npm-asset',
	],
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'language' => 'zh-CN', //默认语言
	'timeZone' => 'Asia/Shanghai', //默认时区
    'modules' => [
            'gii' => [
                    'class' => 'common\modules\gii\Module',
            ],
            'attachment' => [
                    'class' => 'common\modules\attachment\Module',
            ],
    ],
    'controllerMap' => [
            'upload' => [
                'class' => 'common\modules\attachment\actions\UploadController',
            ],
    ],    
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
        'formatter' => [
            'dateFormat' => 'php:Y-m-d H:i',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CHY',
            'nullDisplay' => '-',
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::className(),
            'viewPath' => '@common/mail',
            'useFileTransport' => false,//false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.feehi.com',  //每种邮箱的host配置不一样
                'username' => 'admin@feehi.com',
                'password' => 'password',
                'port' => '586',
                'encryption' => 'tls',
            ],
            'messageConfig' => [
                'charset' => 'UTF-8',
                'from' => ['admin@feehi.com' => 'Feehi CMS robot ']
            ],
        ],
        'i18n' => [
            'translations' => [ //多语言包设置
                '*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
            ],
        ],                			
	],
];
