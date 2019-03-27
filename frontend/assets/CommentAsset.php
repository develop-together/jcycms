<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 15:54:29
 */
 namespace frontend\assets;

 class CommentAsset extends \yii\web\AssetBundle
 {
 	public $sourcePath = '@frontend/web/static/common';

 	public $css = [
 		'em' => 'css/sinaEmoji.css'
 	];

 	public $js = [
 		'co' => 'plugins/comment.js',
 		'em' => 'plugins/sinaEmoji.js'
 	];

 	public $depends = [];
 }