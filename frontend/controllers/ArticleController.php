<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Article;
use common\models\Category as FrontendCatetory;
use frontend\models\Comment;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use common\components\FrontendController;
use common\components\Utils;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\filters\HttpCache;
use frontend\models\search\ArticleSearch;
use common\components\BaseConfig;

class ArticleController extends FrontendController
{

    // public function behaviors()
    // {
    //     return [
    //         [
    //             'class' => HttpCache::className(),
    //             'only' => ['view'],
    //             'lastModified' => function ($action, $params) {
    //                 $id = Yii::$app->getRequest()->get('id');
    //                 $model = $this->findModel($id);
    //                 $model->updateScanCount();
    //                 if ($model->visibility === BaseConfig::ARTICLE_VISIBILITY_PUBLIC) {
    //                     return $model->updated_at;
    //                 }

    //                 $q = new \yii\db\Query();
    //                 return $q->from('{{%user}}')->max('last_login_at');
    //             },
    //             'etagSeed' => function($action, $params) {
    //                 return Yii::$app->user->getIsGuest();
    //             }
    //         ],
    //     ];
    // }

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
        // Yii::$app->getUser()->setReturnUrl(['article/view', 'id' => $id]);
        $model = Article::find()->with(['category', 'user', 'comments'])->where(['id' => $id])->one();
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
            'scan_count' => $model->getScan_count(),
            'nickname' => Yii::$app->getUser()->getIsGuest() ? '' : Yii::$app->getUser()->identity->username
        ];
    }

    public function actionCommentAjax()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if (! Yii::$app->jcore->open_comment) {
                return ['code' => 10001, 'message' => Yii::t('frontend', 'Website closed comment')];
            }
            $model = $this->findModel($params['article_id']);
            if (!$model->can_comment) {
                return ['code' => 10001, 'message' => Yii::t('frontend', 'This article is not allowed to comment')];
            }

            $commentModel = new Comment();
            return $commentModel->saveData(['Comment' => $params]);
        }
    }

    public function actionAddLike()
    {
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if (!isset($params['id']) || null === ($commentModel = Comment::findOne($params['id']))) {
                throw new NotFoundHttpException(Yii::t("frontend", "Article id {id} is not exists"));
            }

            $num = intval($params['num']) <= 0 ? 0 : intval($params['num']);
            $commentModel->like_count = $num;
            return $commentModel->save(false, ['like_count']);
        }
    }

    private function findModel($id)
    {
        if (null !== ($model = Article::findOne($id))) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t("frontend", "Article id {id} is not exists"));
        }
    }
}