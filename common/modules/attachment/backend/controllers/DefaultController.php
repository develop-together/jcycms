<?php


namespace common\modules\attachment\backend\controllers;

use Yii;
use common\modules\attachment\models\Attachment;
use common\modules\attachment\models\AttachmentSearch;
use yii\imagine\Image;
use common\components\BackendController;
use yii\web\NotFoundHttpException;
use backend\actions\DeleteAction;
use yii\helpers\Url;

class DefaultController extends BackendController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Attachment::className(),
            ],
        ];
    }

    /**
     * Lists all Gather models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttachmentSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                $error = current($model->getFirstErrors());
                return $this->renderJson(0, $error);
            }
        }

        $content = $this->renderPartial('view', [
            'model' => $model
        ]);

        return $this->renderJson(1, $content);
    }

    /**
     * Finds the Attachment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return Attachment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attachment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}