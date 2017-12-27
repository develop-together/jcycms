<?php 
namespace common\modules\attachment\actions;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use common\modules\attachment\models\Attachment;

class UploadAction extends Action
{
	public $path;

	public $uploadOnlyImage = true;

	public $multiple  = false;

	public $base64Data = null;

	public $deleteUrl = ['/upload/delete'];

	public $uploadPostParam = 'fileparams';

	public $uploadData = [];

	public $allowUploadFileType = '';

	private $_validator = 'image';

	public $validatorOptions = [];

	public function init()
	{
		$post = Yii::$app->request->post();
		if (key_exists($this->uploadPostParam, $post)) {			
			$this->uploadData = $post[$this->uploadPostParam];
			$this->allowUploadFileType = $this->uploadData['acceptFileTypes'];
		}

        if ($this->uploadOnlyImage !== true) {
            $this->_validator = 'file';
        }		
	}
	
	public function run()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		if (Yii::$app->request->isAjax) {
			$res = $this->uploadOne();

			return $res;
		} elseif (Yii::$app->request->isPost) {

		}
	}

	private function uploadOne()
	{
		try{
			$attachmentModel = new Attachment();
			if ($attachmentModel->uploadFormPost($this->path, $this->uploadData)) {
				return [
					'id' => $attachmentModel->id, 
					'filename' => $attachmentModel->filename, 
					'extension' => $attachmentModel->extension, 
					'filepath' => Yii::$app->request->baseUrl . '/'. Yii::$app->params['uploadSaveFilePath'] . '/' . $attachmentModel->filepath,
					'filetype' => $attachmentModel->filetype,
				];
			} else {
				return [];
			}

		} catch (Exception $e) {
			$result = ['error' => $e->getMessage()];
		}

		return $result;
	}	
}
