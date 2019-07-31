<?php

namespace common\widgets\fileUploadInput;

use yii\helpers\Html;
use yii\helpers\Json;

class ManyWidget extends MultipleWidget
{
    public $multiple = false;

    public $maxNumberOfFiles = 1;

    /*
        是否允许多次上传（强调一下：多次上传与多图上传效果不一样，在本项目中，类型分别是images，feehi_img）
        多次上传指的是多次上传单图照片，一次只能选择一张
        多图上传指的是一次可以选择多个图片一起上传
    */
    public $many = true;

    public function registerClientScript()
    {
        parent::registerClientScript();
    }
}