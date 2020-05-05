<?php

namespace common\modules\mall;

use Yii;

/**
 * mall module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\mall\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        Yii::configure($this, require  __DIR__ . DIRECTORY_SEPARATOR . 'config.php');
        // custom initialization code goes here
    }
}
