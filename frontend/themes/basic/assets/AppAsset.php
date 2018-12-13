<?php

namespace frontend\themes\basic\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/basic/font-awesome-4.5.0/css/font-awesome.min.css',
        'static/basic/css/bootstrap.min.css',
        'static/basic/css/magnific-popup.css',
        'static/basic/css/templatemo-style.css',
    ];
    public $js = [
        // 'static/js/jquery-1.11.3.min.js',
        'static/basic/js/tether.min.js',
        // 'static/js/bootstrap.min.js',
        'static/basic/js/jquery.singlePageNav.min.js',
        'static/basic/js/jquery.magnific-popup.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\themes\basic\assets\BootstrapAsset',
    ];
}
