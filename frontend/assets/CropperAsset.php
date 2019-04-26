<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 15:54:29
 */
 namespace frontend\assets;

 class CropperAsset extends \yii\web\AssetBundle
 {
 	public $sourcePath = '@frontend/web/static/common/cropper';

 	public $css = [
 		'cropcss' => 'cropper.min.css',
 	];

 	public $js = [
 		'cropjs' => 'cropper.min.js',
 	];

 	public $depends = [];
 }