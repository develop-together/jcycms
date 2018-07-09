<?php

namespace backend\controllers;

use Yii;
use common\models\CarouselItem;
use yii\data\ActiveDataProvider;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * CarouselItemController implements the CRUD actions for CarouselItem model.
 */
class CarouselItemController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => CarouselItem::className(),
            ],
        ];
    }
    
    /**
     * Lists all CarouselItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CarouselItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList($id)
    {
        $query = CarouselItem::find()->where(['carousel_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>[
                'defaultOrder' =>[
                    'created_at' => SORT_DESC,
                ],
            ],
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);     

        return $this->render('list', [
            'id' => $id,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CarouselItem model.
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
     * Creates a new CarouselItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pid)
    {
        $model = new CarouselItem();

        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if ($model->load($params) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));

                return $this->redirect(['list', 'id' => $model->carousel_id]);
            }
        }

        return $this->render('create', [
            'pid' => $pid,
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CarouselItem model.
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
                
                return $this->redirect(['list', 'id' => $model->carousel_id]);
            }
        }

        return $this->render('update', [
            'pid' => $model->carousel_id,
            'model' => $model,
        ]);
    }

    /**
     * Finds the CarouselItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CarouselItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CarouselItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
