<?php

namespace common\modules\mall\controllers;

use Yii;
use common\models\MallSpu;
use common\models\search\MallSpuSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * MallSpuController implements the CRUD actions for MallSpu model.
 */
class MallSpuController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => MallSpu::className(),
            ],
        ];
    }
    
    /**
     * Lists all MallSpu models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new MallSpuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MallSpu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MallSpu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MallSpu();
        $model->spu_code = $model->generateSpuCode();
        $model->flag_saleable = true;
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if ($model->load($params) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MallSpu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if ($model->load($params) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the MallSpu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MallSpu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MallSpu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
