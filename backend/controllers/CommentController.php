<?php

namespace backend\controllers;

use Yii;
use backend\models\Comment;
use backend\models\search\CommentSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * CommentController implements the CRUD actions for Comment model.
 */
class CommentController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Comment::className(),
            ],
        ];
    }

    /**
     * Lists all Comment models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new CommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList($aid)
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new CommentSearch();
        $searchModel->article_id = $aid;
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comment model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAudit($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            $model->setScenario('audit');
            if ($model->load($params) && $model->save()) {
                if (Yii::$app->getRequest()->getIsAjax()) {
                    Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
                    return ['code' => 200, 'message' => Yii::t('app', 'Success')];
                } else {
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                    return $this->redirect(['index']);
                }
            } else {
                if (Yii::$app->getRequest()->getIsAjax()) {
                    Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_JSON;
                    return ['code' => 300, 'message' => Yii::t('app', 'Error')];
                } else {
                    Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Error'));
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('audit', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Comment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comment();

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
     * Updates an existing Comment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
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
     * Finds the Comment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Comment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Comment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
