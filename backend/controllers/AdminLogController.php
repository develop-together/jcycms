<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminLog;
use backend\models\search\AdminLogSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * AdminLogController implements the CRUD actions for AdminLog model.
 */
class AdminLogController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => AdminLog::className(),
            ],
        ];
    }
    
    /**
     * Lists all AdminLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new AdminLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminLog model.
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
     * Finds the AdminLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdminLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminLog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
