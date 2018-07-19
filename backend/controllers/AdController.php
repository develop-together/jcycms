<?php

namespace backend\controllers;

use Yii;
use backend\models\Ad;
use backend\models\search\AdSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use common\components\BaseConfig;

class AdController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Ad::className(),
            ],
        ];
    }

    public function actionIndex()
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new AdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Ad();
        $model->target = BaseConfig::TARGET_BLANK;
        $model->status = BaseConfig::Status_Enable;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = Ad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
