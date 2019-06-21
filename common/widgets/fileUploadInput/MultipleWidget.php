<?php  
	namespace common\widgets\fileUploadInput;

	use Yii;
	use yii\base\Arrayable;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\helpers\Json;
	use yii\helpers\Url;
	use yii\widgets\InputWidget;
	use common\modules\attachment\models\Attachment;
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
		public $deleteUrl = 'upload/delete';

		public $fileInputName;

		public $onlyUrl = false;

		public $parentDivId;

		public $many = false;

		public function init()
		{
	        parent::init();
	        if (empty($this->url)) {
	            if ($this->onlyImage === false) {
	                $this->url = $this->multiple ? 'upload/backend-files-upload' : 'upload/file-upload';
	            } else {
	                $this->url = $this->multiple ? 'upload/images-upload' : 'upload/image-upload';
	                $this->acceptFileTypes = 'image/png, image/jpg, image/jpeg, image/gif, image/bmp';
	            }
	        }

	        if ($this->hasModel()) {
	            $this->name = $this->name ? : Html::getInputName($this->model, $this->attribute);
	            $this->attribute = Html::getAttributeName($this->attribute);
	            $value = $this->formatAttachment($this->model->{$this->attribute});
	            $this->value[] = $value;
	        }

	        $this->fileInputName = md5($this->name);
	        $this->parentDivId = 'Res-' . time();
	        $this->clientOptions = ArrayHelper::merge($this->clientOptions, [
	        	'hiddenInputId' => $this->options['id'],
	            'url' => Url::toRoute([$this->url, 'fileparam' => $this->fileInputName]),
	            'deleteUrl' => urlencode(Url::toRoute([$this->deleteUrl, 'table' => $this->model->tableName(), 'attribute'=> $this->attribute])),
	            'multiple' => $this->multiple,
	            'maxNumberOfFiles' => $this->maxNumberOfFiles,
	            'maxFileSize' => $this->maxFileSize,
	            'acceptFileTypes' => $this->acceptFileTypes,
	            'files' => $this->value?:[],
	            'many' => $this->many
	        ]);
		}

		protected function formatAttachment($attachment)
		{
			$arr = [];
			$attachmentModel = null;
			if (!empty($attachment) && is_string($attachment)) {
				$attachmentModel = Attachment::find()
					->select(['id', 'filetype'])
					->where(['filepath' => $attachment])
					->orderBy(['id' => SORT_DESC])
					->One();
				$arr = [
					'url' => Yii::$app->request->hostInfo . '/' . $attachment,
					'fullname' => $attachment,
				];
			} else if (is_array($attachment)) {
            	return $attachment;
	        } else if ($attachment instanceof Arrayable){
	        	return $attachment->toArray();
	        }
            
			if ($attachmentModel) {
				$arr['id'] = $attachmentModel->id;
				$arr['filetype'] = $attachmentModel->filetype;
			}
			
			return $arr;
		}

		public function run()
		{
			$this->registerClientScript();
			$inputPix = $this->multiple ? '[]' : '';
			$content = '';
			$content = Html::hiddenInput($this->name . $inputPix, null, $this->options);
			$this->wrapperOptions = ArrayHelper::merge(['id' => $this->parentDivId], $this->wrapperOptions);
			$content .= Html::beginTag('div', $this->wrapperOptions);
			$options = Json::encode($this->clientOptions);
			$content .= Html::fileInput($this->fileInputName, null, [
				// 'id' => $this->fileInputName,
				'multiple' => $this->multiple,
				'accept' => $this->acceptFileTypes,
				'onchange' => "ajaxUpload(this,'" . $this->parentDivId. "')",
				'data-options' => $options,
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
	