<?php


namespace backend\assets;

use yii;

class UeditorAsset extends yii\web\AssetBundle
{

    public $basePath = "@web";

    public $sourcePath = '@backend/web/static/js/plugins/ueditor/';

    public $js = [
        'ueditor.all.min.js',
    ];

    public $css = [];


    public $publishOptions = [
        'except' => [
            'php/',
            'index.html',
            '.gitignore'
        ]
    ];

}
