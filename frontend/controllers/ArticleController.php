<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Article;
use common\models\Category as FrontendCatetory;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use common\components\FrontendController;
use yii\helpers\Url;
use yii\filters\HttpCache;
use frontend\models\search\ArticleSearch;

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

	public function actionIndex($cat)
	{
		// Url::remember('/category/' . $model->type . '.html', 'BackDynamic');
        $cate = FrontendCatetory::findCate($cat);
		if (! $cate) {
            throw new NotFoundHttpException(Yii::t('frontend', 'Sorry, there are no classified articles yet.'));
		}

        $serarchModel = new ArticleSearch();
        $dataProvider = $serarchModel->search(Yii::$app->request->getQueryParams(), $cate->id);
		return $this->render('list', [
            'serarchModel' => $serarchModel,
            'cate' => $cate,
            'dataProvider' => $dataProvider
		]);
	}

    public function actionView($id)
    {
        $model = Article::findOne(['id' => $id]);

        return $this->render('view', [
            'model' => $model
        ]);
    }
}