<?php 
namespace common\modules\attachment\actions;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use common\modules\attachment\models\Attachment;

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
/*		$post = Yii::$app->request->post();
		if (key_exists($this->uploadQueryParam, $post)) {			
			$this->uploadData = $post[$this->uploadQueryParam];
			$this->allowUploadFileType = $this->uploadData['acceptFileTypes'];
		}

        if ($this->uploadOnlyImage !== true) {
            $this->_validator = 'file';
        }*/
        if (Yii::$app->request->get($this->uploadQueryParam)) {
        	$this->uploadParam = Yii::$app->request->get($this->uploadQueryParam);
        }
		
		if ($this->uploadOnlyImage !== true) {
		    $this->_validator = 'file';
		}		
	}
	
	public function run()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		if (Yii::$app->request->isAjax) {
			$files = UploadedFile::getInstanceByName($this->uploadParam);
			if (empty($files)) {
				return ['error' => '找不到上传的文件'];
			}

			if(!$this->multiple) {
				$res = $this->uploadOne($files);
			} else {
				$res = $this->uploadMore($files);
			}

			return $res;
		} elseif (Yii::$app->request->isPost) {

		}
	}

	private function uploadOne(UploadedFile $file)
	{
		try{
			 $attachmentModel = new Attachment();
			 $result = $attachmentModel->uploadFormPost($this->path, $file);
			 if ($result) {
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
		} catch(Exception $e) {
			$result = ['error' => $e->getMessage()];
		}

		return $result;
		// try{
		// 	$attachmentModel = new Attachment();
		// 	if ($attachmentModel->uploadFormPost($this->path, $this->uploadData)) {
		// 		return [
		// 			'id' => $attachmentModel->id, 
		// 			'filename' => $attachmentModel->filename, 
		// 			'extension' => $attachmentModel->extension, 
		// 			'filepath' => Yii::$app->request->baseUrl . '/'. Yii::$app->params['uploadSaveFilePath'] . '/' . $attachmentModel->filepath,
		// 			'filetype' => $attachmentModel->filetype,
		// 		];
		// 	} else {
		// 		return [];
		// 	}

		// } catch (Exception $e) {
		// 	$result = ['error' => $e->getMessage()];
		// }

		// return $result;
	}

	private function uploadMore(array $files)
	{
		$res = [];
		foreach ($fieles as $file) {
			$res[] = $this->uploadOne($file);
		}

		return $res;
	}	
}
