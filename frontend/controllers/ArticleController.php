<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Article;
use common\models\Category as FrontendCatetory;
use yii\web\BadRequestHttpException;
use common\components\FrontendController;
use yii\helpers\Url;

class ArticleController extends FrontendController
{
	public function actionIndex($cat = '')
	{
		// Url::remember('/category/' . $model->type . '.html', 'BackDynamic');
		if(! $cat) {
			$cate = FrontendCatetory::findCate($cat);
		}

		return $this->render('list', [

		]);
	}
}