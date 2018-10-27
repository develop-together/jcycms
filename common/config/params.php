<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'mailerEncryption' => 'tls',
    'site' => [
    	'url' => YII_ENV_PROD ? 'http://jcycms.boomyang.cn/' : 'http://frontend.jcycms.com.cn',
    ],
    'uploadSaveFilePath' => 'uploads',
];
