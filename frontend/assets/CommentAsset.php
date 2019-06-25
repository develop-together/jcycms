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
 		'em' => 'css/sinaEmoji.min.css',
 		'cos' => 'css/comment.min.css'
 	];

 	public $js = [
 		'co' => 'plugins/comment.min.js',
 		'em' => 'plugins/sinaEmoji.min.js'
 	];

 	public $depends = [];
 }