<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 15:54:29
 */
 namespace frontend\assets;

 class LayerAsset extends \yii\web\AssetBundle
 {
 	public $sourcePath = '@frontend/web/static/common/layer';

 	public $js = [
 		'lay' => 'layer.js',
 	];

 	public $depends = [];
 }