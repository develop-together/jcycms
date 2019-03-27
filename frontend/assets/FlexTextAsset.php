<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 15:54:29
 */
 namespace frontend\assets;

 class FlexTextAsset extends \yii\web\AssetBundle
 {
 	public $sourcePath = '@frontend/web/static/common';

 	public $css = [];

 	public $js = [
 		'f' => 'plugins/jquery.flexText.js'
 	];

 	public $depends = [];
 }