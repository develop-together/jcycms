<?php 
namespace common\modules\attachment\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;
use common\modules\attachment\ext\YiiUploader;

class UploadAction extends Action
{
	public $path;

	public $uploadOnlyImage = true;

	public $multiple  = false;

	public $base64Data = null;

	public $deleteUrl = ['/upload/delete'];

	public $uploadQueryParam = 'fileparam';

	public $uploadParam = '';

	public $uploadData = [];

	public $allowUploadFileType = '';

	private $_validator = 'image';

	public $validatorOptions = [];

	public function init()
	{
        if (Yii::$app->request->get($this->uploadQueryParam)) {
        	$this->uploadParam = Yii::$app->request->get($this->uploadQueryParam);
        }
		
		if ($this->uploadOnlyImage !== true) {
		    $this->_validator = 'file';
		}		
	}
	
	public function run()
	{
		if (Yii::$app->request->isAjax) {
			Yii::$app->response->format = Response::FORMAT_JSON;
			$files = UploadedFile::getInstanceByName($this->uploadParam);
			if (empty($files)) {
				return ['stateInfo' => '找不到上传的文件', 'statusCode' => 300];
			}

			return $this->uploadOne($files);
		}
	}

	private function uploadOne(UploadedFile $file)
	{
        //默认设置
		if ('image-upload' === $this->id) {
			$config['maxSize'] = Yii::$app->params['uploadConfig']['imageMaxSize'];
			$config['allowFiles'] = Yii::$app->params['uploadConfig']['imageAllowFiles'];
			$config['mimeMap'] = Yii::$app->params['uploadConfig']['imgAllowFileMimes'];
		} else {
			$config['maxSize'] = Yii::$app->params['uploadConfig']['fileMaxSize'];
			$config['allowFiles'] = Yii::$app->params['uploadConfig']['fileAllowFiles'];			
		}

		$uploader = new YiiUploader($file, $config, $this->path);
		$res = $uploader->upload();
		if (false === $res) {
			return ['stateInfo' => $uploader->getStateInfo(), 'statusCode' => 300];
		}

		return $res;
	}
}
