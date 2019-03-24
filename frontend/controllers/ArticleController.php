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
use common\components\BaseConfig;

class ArticleController extends FrontendController
{

    public function behaviors()
    {
        return [
            [
                'class' => HttpCache::className(),
                'only' => ['view'],
                'lastModified' => function ($action, $params) {
                    $id = Yii::$app->getRequest()->get('id');
                    $model = $this->findModel($id);
                    $model->updateScanCount();
                    if ($model->visibility === BaseConfig::ARTICLE_VISIBILITY_PUBLIC) return $model->updated_at;
                },
            ],
        ];
    }

	public function actionIndex($cat)
	{
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
        $model = Article::find()->with(['category', 'user'])->where(['id' => $id])->one();
        $prevModel = Article::find()
            ->with(['category', 'user'])
            ->where(['<', 'id', $id])
            ->orderBy("sort asc,created_at desc,id desc")
            ->limit(1)
            ->one();
        $nextModel = Article::find()
            ->with(['category', 'user'])
            ->where(['>', 'id', $id])
            ->orderBy("sort asc,created_at desc,id desc")
            ->limit(1)
            ->one();
        return $this->render('view', [
            'model' => $model,
            'prevModel' => $prevModel,
            'nextModel' => $nextModel
        ]);
    }

    public function actionViewAjax($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = $this->findModel($id);

        return [
            'scan_count' => $model->getScan_count()
        ];

    }

    private function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t("frontend", "Article id {id} is not exists"));
        }
    }
}