<?php
return [
    'formats' => [
        'application/json' => \yii\web\Response::FORMAT_JSON,
        'application/xml' => \yii\web\Response::FORMAT_XML,
    ],
    // 请求超时时间
    'requestTimeOut' => 300,
    'algo' => 'sha256',
    'user.accessTokenExpire' => 7200,
    'user.refreshTokenExpire' => 7200 + 600,
    'api_url' => 'http://api.jcycms.com.cn',
    'api_username' => 'admin',
    'api_password' => '$2y$13$eLoLOkmlHPzD4dchr2a4IOJjbJrFgN/1nBwUxFHjjxmt8drGPUUZy',
    'web_site' => 'http://blog.yjcweb.tk',
    'app_key' => 'joBVVQxfMxDmhuxV20',
    'app_secret' => 'YJF5P8qCFJakF9Ve89ZcIstHKbkt4fVN',
];
