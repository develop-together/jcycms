<?php 
namespace backend\actions;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class DeleteAction extends \yii\base\Action
{
	public $modelClass;

	public function run($id)
	{
		
		if (!$id) {
			throw new BadRequestHttpException(yii::t('app', 'Id doesn\'t exit'));
		}

		$model = call_user_func([$this->modelClass, 'findOne'], $id);
		if ($model && $model->delete()) {
			//yii::$app->getSession()->setFlash('success', yii::t('app', 'Delete Success'));
		}

		return $this->controller->redirect(yii::$app->request->headers['referer']);
	}
}
