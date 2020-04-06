<?php

namespace common\widgets\fileUploadInput;

use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\InputWidget;

class FileUploadInputWidget extends InputWidget
{
    public $type;

    public $types = ['image', 'images', 'file', 'feehi_img', 'feehi_imgs'];/*feehi_img 是仿照feehi写的一个图片上传控件*/

    public $inputOptions = ['class' => 'form-control'];

    public $widgetOptions = [];

    public $notes = '';

    public function init()
    {
        parent::init();
        if (!in_array($this->type, $this->types)) {
            throw new InvalidParamException('不支持该类型!');
        }

        if (empty($this->widgetOptions)) {
            $this->widgetOptions = ArrayHelper::remove($this->options, 'widgetOptions', []);

        }


    }

    public function run()
    {
        if ($this->hasModel()) {
            return $this->parseActive();
        } else {
            return $this->parse();
        }
    }

    // 活动记录表单解析
    private function parseActive()
    {
        switch ($this->type) {
            case 'image'://单图上传
                return SingleWidget::widget(ArrayHelper::merge(['model' => $this->model, 'attribute' => $this->attribute, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'images'://多次图片上传
                return ManyWidget::widget(ArrayHelper::merge(['model' => $this->model, 'attribute' => $this->attribute, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'file'://单文件上传
                return SingleWidget::widget(ArrayHelper::merge(['model' => $this->model, 'attribute' => $this->attribute, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'feehi_img'://飞嗨单图上传
                return FeehiWidget::widget(['model' => $this->model, 'attribute' => $this->attribute, 'onlyUrl' => true, 'wrapperOptions' => $this->widgetOptions]);

                break;
            case 'feehi_imgs'://飞嗨多图上传
                return FeehiWidget::widget(['model' => $this->model, 'attribute' => $this->attribute . '[]', 'onlyUrl' => true, 'multiple' => true, 'placeHolder' => '多图片上传，一次可选择多张图片!', 'wrapperOptions' => $this->widgetOptions]);

                break;
            default:
                break;
        }
    }

    //表单解析
    private function parse()
    {
        switch ($this->type) {
            case 'image'://单图上传
                return SingleWidget::widget(ArrayHelper::merge(['name' => $this->name, 'value' => $this->value, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'images'://多次图片上传
                return ManyWidget::widget(ArrayHelper::merge(['name' => $this->name, 'value' => $this->value, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'file'://单文件上传
                return SingleWidget::widget(ArrayHelper::merge(['name' => $this->name, 'value' => $this->value, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'feehi_img'://飞嗨单图上传
                return FeehiWidget::widget(ArrayHelper::merge(['name' => $this->name, 'value' => $this->value, 'onlyUrl' => true], $this->widgetOptions));

                break;
            case 'feehi_imgs'://飞嗨多图上传
                return FeehiWidget::widget(ArrayHelper::merge(['name' => $this->name . '[]', 'value' => $this->value, 'onlyUrl' => true, 'multiple' => true], $this->widgetOptions));

                break;
            default:
                break;
        }
    }
}