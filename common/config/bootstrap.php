<?php
Yii::setAlias('@root', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@fontFile', '@common/static/fonts');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@gii', dirname(__DIR__) . '/modules/gii');
Yii::setAlias('@uploads', '@backend/web/uploads');//文件上传目录
Yii::setAlias('@thumb', '@uploads/thumb');//文章缩略图上传目录
Yii::setAlias('@original', '@uploads/original');//文章原图上传目录
Yii::setAlias('@friendlylink', '@uploads/friendlylink');//友情链接图片上传目录
Yii::setAlias('@banner', '@uploads/banner');//Banner图片上传目录
Yii::setAlias('@ad', '@uploads/ad');//广告图片上传目录
