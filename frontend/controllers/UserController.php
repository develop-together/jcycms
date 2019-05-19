<?php

namespace frontend\controllers;

use Yii;
use frontend\models\search\UserSearch;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use common\components\FrontendController;
use common\components\Utils;
use frontend\models\User;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class UserController extends FrontendController
{
	public function actionCenter()
	{
		return $this->render('center', ['tpl' => 'basic']);
	}

	public function actionAvatarSetting()
	{
		if (Yii::$app->request->isAjax && Yii::$app->request->isPost) {
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			$data = Yii::$app->request->post();
			$model = User::findOne(Yii::$app->user->id);
			$model->setScenario('avatar-setting');
			if ($model->save(false, ['avatar', 'updated_at'])) {
				return ['statusCode' => 200, 'message' => Yii::t('frontend', 'The avatar was set successfully')];
			}

			return ['statusCode' => 300, 'message' => Yii::t('frontend', 'Failed to set avatar')];
		}
		return $this->render('center', ['tpl' => 'avatar-setting']);
	}

	public function actionSafetySetting()
	{
		return $this->render('center', ['tpl' => 'safety-setting']);
	}
}