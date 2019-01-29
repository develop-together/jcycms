<?php
/**
 * 
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 15:24:23
 */
 namespace frontend\assets;

 use yii\web\AssetBundle;

 class FontsAsset extends AssetBundle
 {
 	public $sourcePath = '@frontend/web/static/common';

 	public $css = [
 		'f' => 'fonts/style.css'
 	];

 	public $js = [];
 }