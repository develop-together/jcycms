<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'i18n' => [
            'translations' => [
                'common*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@common/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'common.php',
                        'app/error' => 'error.php',

                    ],
                ],
                'front*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'frontend' => 'frontend.php',
                        'app/error' => 'error.php',

                    ],
                ],
            ],
        ],
        'assetManager' => [
            'linkAssets' => false,
        ],
        'view' => [
            'theme' => 'common\\components\\ThemeManager'
        ],
        // 'view' => [
        //     'theme' => [
        //         // 'basePath' => '@app/themes/basic',
        //         // 'baseUrl' => '@web/themes/basic',
        //         'pathMap' => [
        //             '@app/views' => [
        //                 '@app/themes/template2',
        //                 '@app/themes/template1',
        //                 '@app/themes/basic',
        //             ],
        //         ],
        //     ],
        // ],
    ],
    'params' => $params,
];
