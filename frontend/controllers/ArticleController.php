<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Article;
use common\models\Category as FrontendCatetory;
use yii\web\BadRequestHttpException;
use common\components\FrontendController;
use yii\helpers\Url;
use yii\filters\HttpCache;

class ArticleController extends FrontendController
{

    public function behaviors()
    {
        return [
            [
                'class' => HttpCache::className(),
                'only' => ['view'],
                'lastModified' => function ($action, $params) {
                    $id = yii::$app->getRequest()->get('id');
                    // , 'type' => Article::ARTICLE, 'status' => Article::ARTICLE_PUBLISHED
                    $model = Article::findOne(['id' => $id]);
                    if( $model === null ) throw new NotFoundHttpException(yii::t("frontend", "Article id {id} is not exists", ['id' => $id]));
                    // Article::updateAllCounters(['scan_count' => 1], ['id' => $id]);
                    // if($model->visibility == Constants::ARTICLE_VISIBILITY_PUBLIC) return $model->updated_at;
                },
            ],
        ];
    }

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