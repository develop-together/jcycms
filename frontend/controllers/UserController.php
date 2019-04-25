<?php

namespace frontend\controllers;

use Yii;
use frontend\models\search\UserSearch;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use common\components\FrontendController;
use common\components\Utils;
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
		return $this->render('center', ['tpl' => 'avatar-setting']);
	}

	public function actionSafetySetting()
	{
		return $this->render('center', ['tpl' => 'safety-setting']);
	}
}