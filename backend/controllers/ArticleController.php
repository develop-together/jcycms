<?php

namespace backend\controllers;

use Yii;
use backend\models\Article;
use common\models\ArticleContent;
use backend\models\search\ArticleSearch;
use yii\web\Controller;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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

                if (!$model->save()) {
                    $errs = [];
                    foreach ($model->getErrors() as $error) {
                        $errs[] = $error[0];
                    }

                    throw new \yii\web\BadRequestHttpException(implode('<br>', $errs));
                }

                $articleContentModel = new ArticleContent();
                $articleContentModel->article_id = $model->id;
                $articleContentModel->content = $model->content;
                if (!$articleContentModel->save()) {
                    $articleContentErrs = [];
                    foreach ($articleContentModel->getErrors() as $aError) {
                        $articleContentErrs[] = $aError[0];
                    }

                    throw new \yii\web\BadRequestHttpException(implode('<br>', $articleContentErrs));
                }

                Yii::$app->session->setFlash('success', "操作成功");
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * 改变某个字段状态操作
     *
     * @param string $id
     * @param int $status
     * @param string $field
     * @return array|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionStatus($id, $status = 0, $field = 'status')
    {
        if (! $id) {
            throw new BadRequestHttpException(yii::t('app', "Id doesn't exit"));
        }

        $model->$field = $status;
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\View\FORMAT_JSON;
            if(! $model->save(false)) {
                $errs = [];
                foreach ($model->getErrors() as $error) {
                    $errs[] = $error[0];
                }

                return ['statusCode' => 300, 'message' => implode('<br>', $errs)];
            } else {
                return ['statusCode' => 200, 'message' => '操作成功'];
            }
        } else {
            if (! $model->save()) {
                $errs = [];
                foreach ($model->getErrors() as $error) {
                    $errs[] = $error[0];
                }

                Yii::$app->session->setFlash('error', implode('<br>', $errs));
            }

            return $this->redirect(['index']);
        }
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
