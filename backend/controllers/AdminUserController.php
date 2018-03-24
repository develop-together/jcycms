<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\search\UserSearch;
use backend\models\AdminRoleUser;
use backend\models\AdminRoles;
use common\components\BackendController;
use yii\web\NotFoundHttpException;
use backend\actions\DeleteAction;

/**
 * AdminUserController implements the CRUD actions for User model.
 */
class AdminUserController extends BackendController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => User::className(),
            ],
        ];
    }
    
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->setScenario('create');
        $model->status = User::STATUS_ACTIVE;
        $rolesModel = new AdminRoleUser();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'rolesModel' => $rolesModel,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');
        $rolesModel = AdminRoleUser::findOne(['user_id' => $id]);
        if (!$rolesModel) {
            $rolesModel = new AdminRoleUser();
            $rolesModel->user_id = $id;
        }

        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) 
                && $model->validate() 
                && $rolesModel->load(Yii::$app->request->post()) 
                && $model->save()  
                && $rolesModel->validate() 
                && $rolesModel->save()) {
                Yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));
                return $this->redirect(['index']);
            } else {
                $errors = $model->getErrors();
                $err = '';
                foreach ($errors as $v) {
                    $err .= $v[0] . '<br>';
                }
                Yii::$app->getSession()->setFlash('error', $err);  
            }
        } 

        return $this->render('update', [
            'model' => $model,
            'rolesModel' => $rolesModel,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAssignment($id)
    {   
        $model = $this->findModel($id);
        $roleLists = AdminRoles::loadRolesOptions();
        return $this->render('assignment', ['model' => $model, 'roleLists' => $roleLists]);        
    }
}
