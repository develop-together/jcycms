<?php
$config = [
    'name' => 'JCYCMS',
    'version' => '1.0.0',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN', //默认语言
    'timeZone' => 'Asia/Shanghai', //默认时区
    'modules' => [
        'attachment' => [
            'class' => 'common\modules\attachment\Module',
//            'controllerMap' => [
//                'upload' => [
//                    'class' => 'common\modules\attachment\actions\UploadController',
//                ],
//            ]
        ],
        'mall' => [
            'class' => 'common\modules\mall\Module',
        ],
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
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
        'jcore' => [
            'class' => jcore\components\Jcore::className()
        ],
        'i18n' => [
            'translations' => [ //多语言包设置
                'common*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'common' => 'common.php',
                    ],
                ],
                'mall' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'mall' => 'mall.php',
                    ],
                ],
            ],
        ],
    ],
];

return $config;