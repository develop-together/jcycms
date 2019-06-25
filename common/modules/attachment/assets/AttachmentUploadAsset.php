<?php
namespace common\modules\attachment\assets;

use yii\web\AssetBundle;

class AttachmentUploadAsset extends AssetBundle
{
    public $sourcePath = '@common/modules/attachment/static';
    public $css = [
        'attachment-upload.css',
    ];
    public $js = [
        'attachment-upload.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'backend\assets\AppAsset'
    ];
}

?>