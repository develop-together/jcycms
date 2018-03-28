<?php

namespace backend\controllers;

use Yii;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\helpers\FileHelper;

class ClearController extends BackendController 
{
	public function actionBackend()
	{
		FileHelper::removeDirectory(yii::getAlias('@runtime/cache'));
        Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
        return $this->render('clear');
	}

	public function actionFrontend()
	{
		FileHelper::removeDirectory(yii::getAlias('@frontend/@runtime/cache'));
        Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
        return $this->render('clear');
	}
}
?>