<?php

namespace backend\assets;

use yii\web\AssetBundle;

class TypeaHeadAsset extends AssetBundle
{
    public $sourcePath = '@bower/typeahead.js/dist';
    
    public $css = [];
    
    public $js = [
        'typeahead.bundle.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
