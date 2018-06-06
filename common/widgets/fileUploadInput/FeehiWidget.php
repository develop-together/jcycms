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
		
	public $wrapperOptions = [];

	public $inputId = '';

	//允许上传最大限制
	public $maxFileSize;

	//允许上传附件的类型
	public $acceptFileTypes;

	public $parentDivId;

	public $onlyUrl = false;

	public $multiple = false;

	public $placeHolder = '';

	public function init()
	{
        parent::init();
        if ($this->hasModel()) {
            $this->name = $this->name ? : Html::getInputName($this->model, $this->attribute);
            $this->attribute = Html::getAttributeName($this->attribute);
            if ($this->attribute === 'photo_file_ids') {
            	$value = $this->model->{$this->attribute};
            	$this->value = $this->model->getPictures();
/*            	$attachmentModels = Attachment::find()
            		->where(['in', 'id', explode(',', $value)])
            		->all();
            	$data = [];
            	if ($attachmentModels) {
            		foreach ($attachmentModels as $attachmentModel) {
            			$data[$attachmentModel->id] = $attachmentModel;
            		}
            	}

            	$this->value = $data;*/
            } else {
            	$this->value = $this->model->{$this->attribute};
            }
            
        }

        $this->acceptFileTypes = 'image/png, image/jpg, image/jpeg, image/gif, image/bmp';
        $this->inputId = 'feehi-' . $this->name;
        $this->parentDivId = 'feehi-res-' . time();
	}

	public function run()
	{
		$imgHtml = $inputValue = '';
		if (is_array($this->value)) {
			foreach ($this->value as $key => $value) {
				$src = Yii::$app->request->baseUrl . (!empty($value->filepath) ? '/' . $value->filepath : '/static/img/none.jpg');
				$imgHtml .=  '<img src="' . $src . '" alt="" style="max-width:200px;max-height:200px;    display: block;float: left;padding-right: 5px;" class="mutil_image" data-file-id="' . $key . '">';
				$inputValue .= $value->filename . '、';
			}
		} else {
			$src = Yii::$app->request->baseUrl . (!empty($this->value) ? '/' . $this->value : '/static/img/none.jpg');
			$imgHtml = '<img src="' . $src . '" alt="" style="max-width:200px;max-height:200px" class="none_image">';
		}
		$content = Html::hiddenInput($this->name, null, $this->options);
		$this->wrapperOptions = ArrayHelper::merge(['id' => $this->parentDivId, 'class' => 'image'], $this->wrapperOptions);
		$content .= Html::beginTag('div', $this->wrapperOptions);
		$content .= Html::fileInput($this->name, null,[
			'id' => $this->inputId,
			'class' => 'feehi_html5_upload',
			'accept' => $this->acceptFileTypes,
			'multiple' => $this->multiple,
			'style' => 'max-width: 200px; max-height: 200px; display: none;',
		]);
		$content .= '<div class="input-append input-group"><span class="input-group-btn"><button class="btn btn-white" type="button">选择文件</button></span><input class="input-large form-control filename_lists" type="text" readonly placeHolder="' . $this->placeHolder . '" value="' . rtrim($inputValue, '、') . '" ></div>' . $imgHtml . '<div class="help-block m-b-none"></div>';
		$content .= Html::endTag('div');

		return $content;
	}
}
