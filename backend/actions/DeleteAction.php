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
		
		if (Yii::$app->request->isAjax) {
			Yii::$app->getResponse()->format = Response::FORMAT_JSON;
			if (!$id) {
				return ['code' => 300, 'message' => Yii::t('app', "Id doesn't exit")];
			}

			$ids = explode(',', $id);
			$errorIds = [];
			$model = null;
			foreach ($ids as $id) {
				$model = call_user_func([$this->modelClass, 'findOne'], $id);
				if (!$model->delete()) {
					$errorIds[] = $id;
				}
			}

			if (count($errorIds)) {
				$errors = $model->errors;
				$err = [];
				foreach ($errors as $error) {
					$err[] = $error[0];
				}

				return ['code' => 300, 'message' => implode(',', $errorIds) . implode('<br>', $err)];
			}
			
			return ['code' => 200, 'message' => Yii::t('app', 'Success')];
		}

		if (!$id) {
			throw new BadRequestHttpException(Yii::t('app', "Id doesn't exit"));
		}

		$model = call_user_func([$this->modelClass, 'findOne'], $id);
		if ($model && $model->delete()) {
			yii::$app->getSession()->setFlash('success', Yii::t('app', 'Delete Success'));
		}

		return $this->controller->redirect(yii::$app->request->headers['referer']);
	}
}
