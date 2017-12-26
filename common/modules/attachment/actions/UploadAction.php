<?php 
namespace common\modules\attachment\actions;

use Yii;
use yii\base\Action;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class UploadAction extends Action
{
	public $path;

	public $uploadOnlyImage = true;

	public $multiple  = false;

	public $base64Data = null;

	public $deleteUrl = ['/upload/delete'];

	public $uploadPostParam = 'fileparams';

	public $uploadData = [];

	public function init()
	{
		$post = Yii::$app->request->post();
		if (key_exists($this->uploadPostParam, $post)) {
			$this->uploadData = $post[$this->uploadPostParam];
		}
	}
	public function run()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		if (Yii::$app->request->isAjax) {
			return $this->uploadData;
		} elseif (Yii::$app->request->isPost) {

		}
	}

}
