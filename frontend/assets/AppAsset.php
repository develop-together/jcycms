<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/font-awesome-4.5.0/css/font-awesome.min.css',
        'static/css/bootstrap.min.css',
        'static/css/magnific-popup.css',
        'static/css/templatemo-style.css',
    ];
    public $js = [
        // 'static/js/jquery-1.11.3.min.js',
        'static/js/tether.min.js',
        // 'static/js/bootstrap.min.js',
        'static/js/jquery.singlePageNav.min.js',
        'static/js/jquery.magnific-popup.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'frontend\assets\BootstrapAsset',
    ];
}
