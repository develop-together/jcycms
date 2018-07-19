<?php

namespace backend\controllers;

use Yii;
use backend\models\Article;
use backend\models\search\ArticleSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => Article::className(),
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

        $searchModel = new ArticleSearch();
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
        $model = new Article();
        $model->sort = 0;
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $model->setScenario('article');
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!$model->load($post)) {
                    throw new \yii\web\BadRequestHttpException('数据提交出错');
                }
                
                $model->saveArticle() && Yii::$app->session->setFlash('success', "操作成功");
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
            $model->setScenario('article');
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!$model->load($post)) {
                    throw new \yii\web\BadRequestHttpException('数据提交出错');
                }

                $model->saveArticle() && Yii::$app->session->setFlash('success', "操作成功");
                $transaction->commit();

                return $this->redirect(['index']);
            } catch(\Expression $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
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
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
