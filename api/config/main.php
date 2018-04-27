<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',//应用id，必须唯一
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',//控制器命名空间
    'language' => 'zh-CN',//默认语言
    'timeZone' => 'Asia/Shanghai',//默认时区
    'bootstrap' => ['log'],
    'components' => [
        'user' => [
            'class' => yii\web\User::className(),
            'identityClass' => api\models\User::className(),
            'enableAutoLogin' => false,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'appClient' => [
            'class' => api\components\AppClient::className(),
            'clientClass' => api\models\AppClient::className(),
        ],
        'cache' => [
            'class' => yii\caching\FileCache::className(),
            'keyPrefix' => 'frontend',
        ],
        'log' => [//此项具体详细配置，请访问http://wiki.feehi.com/index.php?title=Yii2_log
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::className(),//当触发levels配置的错误级别时，保存到日志文件
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                if (!in_array(Yii::$app->controller->id, ['site', 'docs'])) {
                    $response = $event->sender;
                    // 替换相对路径
                    $website = str_replace('/', '\/', Yii::$app->params['web_site']);
                    $data = preg_replace('@(?<=")\\\\\/uploads@', $website . '\/uploads', json_encode($response->data));
                    $data = json_decode($data, true);
                    // $data = $response->data;
                    $message = isset($data['message']) ? $data['message'] : $response->statusText;
                    if (isset($data['statusCode']) || (isset($data['status']) && isset($data['code']))) {
                        $data = '';
                    }

                    $response->data = [
                        'status' => $response->getStatusCode(),
                        'message' => $message,
                        'data' => $data,
                    ];
                    
                    $response->format = yii\web\Response::FORMAT_JSON;
                }
            },
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,//隐藏index.php
            'enableStrictParsing' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ]
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::className(),
                    'basePath' => '@api/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
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
    ],
    'params' => $params,
];
