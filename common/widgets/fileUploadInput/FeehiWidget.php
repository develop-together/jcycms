<?php
/**
 * Author: yjc to lf
 * Blog: http://blog.yjcweb.tk
 * Email: 2064320087@qq.com
 * Description: 该组件是仿照feehi制作，仅供学习，致敬fei哥
 * Created at: 2018-04-10
 */

namespace common\widgets\fileUploadInput;

use Yii;
use yii\base\Arrayable;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;
use common\modules\attachment\models\Attachment;

class FeehiWidget extends InputWidget
{
	//允许上传最大限制
	public $maxFileSize;

	//允许上传附件的类型
	public $acceptFileTypes;

	public $parentDivId;

	public $wrapperOptions = [];

	public $inputId        = '';

	public $onlyUrl        = false;

	public $multiple       = false;

	public $placeHolder    = '';

	public function init()
	{
        parent::init();

        if ($this->hasModel()) {
            $this->name = $this->name ? : Html::getInputName($this->model, $this->attribute);
            $this->attribute = Html::getAttributeName($this->attribute);
            if ($this->attribute === 'photo_file_ids') {
            	$value = $this->model->{$this->attribute};
            	$this->value = $this->model->getPictures();
            } else {
            	$this->value = $this->model->{$this->attribute};
            }

        }

        $this->acceptFileTypes = 'image/png, image/jpg, image/jpeg, image/gif, image/bmp';
        $this->inputId = strtolower($this->model->formName()) . '-' . $this->attribute;//'feehi-' . $this->name;
        $this->parentDivId = 'feehi-res-' . time();
	}

	public function run()
	{
		$imgHtml = '';
		$inputValue = $this->value;
		$inputName = $this->name;
		$maxWidth = $maxHeight = '200px';

		if (isset($this->wrapperOptions['max-width'])) {
			$maxWidth =  $this->wrapperOptions['max-width'];
		}

		if (isset($this->wrapperOptions['max-height'])) {
			$maxHeight =  $this->wrapperOptions['max-height'];
		}

		if (is_array($this->value)) {
			$inputValue = '';

			array_walk($this->value, function($value) use (&$inputValue, &$imgHtml, $maxWidth, $maxHeight, $inputName) {
				$src = Yii::$app->request->baseUrl . (!empty($value->filepath) ? '/' . $value->filepath : '/static/img/none.jpg');
				$imgHtml .= "<div class='multi-item col-lg-3 col-sm-3 col-md-3'><i class='fa fa-trash cancels' style='position: absolute;right:3px;top: -3px;z-index:999;font-size: 14px;color: red;' data-file='{$value->filename}' data-fid='{$value->id}' data-input='{$this->inputId}'></i><img class='img-thumbnail' src='{$src}'/><input type='hidden' -name='{$inputName}' value='{$value->filepath}'></div>";
				$inputValue .= $value->filename . '、';
			});
		} else {
			$src = Yii::$app->request->baseUrl . (!empty($this->value) ? '/' . $this->value : '/static/img/none.jpg');
			"<div class='multi-item col-lg-3 col-sm-3 col-md-3'><i class='fa fa-trash cancels' style='position: absolute;right:3px;top: -3px;z-index:999;font-size: 14px;color: red;' data-file='{$this->value}'></i><img class='img-thumbnail' src='{$src}'/><input type='hidden' -name='{$inputName}' value='{$this->value}'></div>";
		}

		$content = '';
		$this->wrapperOptions = ArrayHelper::merge(['id' => $this->parentDivId, 'class' => 'image'], $this->wrapperOptions);
		$content .= Html::beginTag('div', $this->wrapperOptions);
		// $inputValue
		$content .= Html::fileInput($this->name, null, [
			'id' => $this->inputId,
			'class' => 'feehi_html5_upload',
			'accept' => $this->acceptFileTypes,
			'multiple' => $this->multiple,
			'data-resize-name' => str_replace($this->attribute, 'resize_' . $this->attribute, $this->name),
			'style' => 'max-width: ' . $maxWidth . '; max-height: ' . $maxHeight . '; display: none;',
		]);
		$content .= '<div class="input-append input-group"><span class="input-group-btn"><button class="btn btn-white" type="button">选择文件</button></span><input class="input-large form-control filename_lists" type="text" readonly placeHolder="' . $this->placeHolder . '" value="' . rtrim($inputValue, '、') . '" ><input type="hidden" name="' . str_replace([$this->attribute, '[]'], ['del_file_' . $this->attribute, ''], $this->name) . '" id="del_file_' . $this->inputId . '" data-del-file=""/></div><div class="multi-img-details">' . $imgHtml . '<div class="clearFix"></div></div>';// . '<div class="help-block m-b-none"></div>'
		$content .= Html::endTag('div');

		return $content;
	}
}
