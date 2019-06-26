<?php

namespace backend\controllers;

use Yii;
use backend\models\PhotosArticle;
use backend\models\search\PhotosArticleSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * PhotosController implements the CRUD actions for Article model.
 */
class PhotosController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => PhotosArticle::className(),
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new PhotosArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhotosArticle();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!$model->load($post)) {
                    throw new \yii\web\BadRequestHttpException(Yii::t('app', 'Error in data submission!'));
                }

                if (!$model->save()) {
                    $errors = [];
                    foreach ($model->errors as $error) {
                        $errors[] = $error[0];
                    }
                    throw new \yii\web\BadRequestHttpException(implode(",", $errors));
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                $transaction->commit();

                return $this->redirect(['index']);
            } catch(\Expression $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!$model->load($post)) {
                    throw new \yii\web\BadRequestHttpException(Yii::t('app', 'Error in data submission!'));
                }

                if (!$model->save()) {
                    $errors = [];
                    foreach ($model->errors as $error) {
                        $errors[] = $error[0];
                    }
                    throw new \yii\web\BadRequestHttpException(implode(",", $errors));
                }

                $transaction->commit();
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;       
                    return ['statusCode' => 200, 'message' => Yii::t('app', 'Success'), 'href' => Url::toRoute('index')];
                } else {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                    return $this->redirect(['index']);                    
                }

            } catch(\Expression $e) {
                $transaction->rollBack();
                if (Yii::$app->request->isAjax) {
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['statusCode' => 300, 'message' => $e->getMessage()];
                } else {
                    Yii::$app->session->setFlash('error', $e->getMessage());
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhotosArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShowPictures($id)
    {
        $model = $this->findModel($id);
        $data = [];
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->pictures) {
                foreach ($model->pictures as $picture) {
                    $data[] = [
                        'alt' => $picture->filename,
                        'pid' => $picture->id,
                        'src' => Yii::$app->request->baseUrl . '/' . $picture->filepath,
                        'thumb' => $picture->filepath,
                    ];
                }
            }

            return [
                'title' => $model->title,
                'id' => $id,
                'start' => 0,
                'data' => $data
            ];
        } else {
            return $data;
        }
    }

}
