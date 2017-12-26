<?php  
	namespace common\widgets\fileUploadInput;

	use yii\base\Arrayable;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\helpers\Json;
	use yii\helpers\Url;
	use yii\widgets\InputWidget;
	use common\modules\attachment\assets\AttachmentUploadAsset;
	
	class MultipleWidget extends InputWidget
	{
		public $onlyImage = true;
		
		public $wrapperOptions;

		// 客户端选项,构成$clientOptions
		public $clientOptions = [];

		//上传URL地址
		public $url = [];

		// 这里为了配合后台方便处理所有都是设为true,文件上传数目请控制好 $maxNumberOfFiles
		public $multiple = true;

		//允许上传的最大文件数目
		public $maxNumberOfFiles = 50;

		//允许上传最大限制
		public $maxFileSize;

		//允许上传附件的类型
		public $acceptFileTypes;

		//删除上传附件的URL
		public $deleteUrl = ['/upload/delete'];

		public $fileInputName;

		public $onlyUrl = false;

		public $parentDivId;

		public function init()
		{
	        parent::init();
	        if (empty($this->url)) {
	            if ($this->onlyImage === false) {
	                $this->url = $this->multiple ? ['/upload/backend-files-upload'] : ['/upload/file-upload'];
	            } else {
	                $this->url = $this->multiple ? ['/upload/images-upload'] : ['/upload/image-upload'];
	                $this->acceptFileTypes = 'image/png, image/jpg, image/jpeg, image/gif, image/bmp';
	            }
	        }

	        if ($this->hasModel()) {
	            $this->name = $this->name ? : Html::getInputName($this->model, $this->attribute);
	            $this->attribute = Html::getAttributeName($this->attribute);
	            $value = $this->model->{$this->attribute};
	            $attachments = $this->multiple == true ? $value :[$value];
	            $this->value = [];
	            if ($attachments) {
	                foreach ($attachments as $attachment) {
	                    $value = $this->formatAttachment($attachment);
	                    if ($value) {
	                        $this->value[] = $value;
	                    }
	                }
	            }

	        }

	        $this->fileInputName = md5($this->name);
	        $this->parentDivId = 'Res-' . time();
	        if (! array_key_exists('fileparam', $this->url)) {
	            $this->url['fileparam'] = $this->fileInputName;//服务器需要通过这个判断是哪一个input name上传的
	        }

	        $this->clientOptions = ArrayHelper::merge($this->clientOptions, [
	            'id' => $this->options['id'],
	            'name'=> $this->name, //主要用于上传后返回的项目name
	            'url' => Url::to($this->url),
	            'multiple' => $this->multiple,
	            'maxNumberOfFiles' => $this->maxNumberOfFiles,
	            'maxFileSize' => $this->maxFileSize,
	            'acceptFileTypes' => $this->acceptFileTypes,
	            'files' => $this->value?:[]
	        ]);
		}

		protected function formatAttachment($attachment)
		{
			if (!empty($attachment) && is_string($attachment)) {
				return [
					'url' => $attachment,
					'path' => $attachment,
				];
			} elseif (is_array($attachment)) {
				return $attachment;
			} elseif ($attachment instanceof Arrayable) {
				return $attachment->toArray();
			}

			return [];
		}

		public function run()
		{
			$this->registerClientScript();
			$inputPix = $this->multiple ? '[]' : '';
			$content = Html::hiddenInput($this->name . $inputPix, null, $this->options);
			$this->wrapperOptions = ArrayHelper::merge(['id' => $this->parentDivId], $this->wrapperOptions);
			$content .= Html::beginTag('div', $this->wrapperOptions);
			$options = Json::encode($this->clientOptions);
			$content .= Html::fileInput($this->fileInputName, null,[
				'id' => $this->fileInputName,
				'multiple' => $this->multiple,
				'accept' => $this->acceptFileTypes,
				'onchange' => "ajaxUpload(this,'" . $this->parentDivId. "', {$options})",
			]);
			$content .= Html::endTag('div');

			return $content;
		}

		public function registerClientScript()
		{
			Html::addCssClass($this->wrapperOptions, "upload-kit-input");
			AttachmentUploadAsset::register($this->getView());
		}
	}
	