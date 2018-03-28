<?php

namespace backend\controllers;

use Yii;
use backend\models\AdminRoles;
use backend\models\AdminRolePermission;
use backend\models\Menu;
use yii\data\ActiveDataProvider;
use common\components\BackendController;
use common\components\Utils;
use yii\web\NotFoundHttpException;
use backend\actions\DeleteAction;

class AdminRolesController extends BackendController
{

    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => AdminRoles::className(),
            ],
        ];
    }
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AdminRoles::find(),
            'sort' => [
                'defaultOrder' => [
                        'created_at' => SORT_ASC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', [
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
        $model = new AdminRoles();
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));

                return $this->redirect(['index']);
            } else {
                $errors = $model->getErrors();
                $err = [];
                foreach ($errors as $error) {
                    $err[] = $error[0];
                }

                Yii::$app->session->setFlash('error', implode('<br>', $err));
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);       
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                yii::$app->getSession()->setFlash('success', yii::t('app', 'Success'));

                return $this->redirect(['index']);
            } else {
                $errors = $model->getErrors();
                $err = [];
                foreach ($errors as $error) {
                    $err[] = $error[0];
                }

                Yii::$app->session->setFlash('error', implode('<br>', $err));
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAssign($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->id != AdminRoles::SUPER_ROLE_ID) {
                Yii::$app->session->setFlash('error', "非法操作");
            }

            // $postData = Yii::$app->request->post();
            // if ($postData['menuLists']) {
            //     $menuLists = explode(',', $postData['menuLists']);
            //     foreach ($menuLists as $value) {
            //         $adminRolePermissionModel = $this->findAdminRolePermissionModel();
            //     }
            // }
            exit;
        }
        
        return $this->render('assign', [
            'model' => $model,
        ]);
    }

    public function actionAjaxMenuNodes($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $adminRolePermissionLists = AdminRolePermission::find()
                ->where(['role_id' => $id])
                ->asArray()
                ->all();
            $adminRolePermissionLists = !$adminRolePermissionLists ? [] : $adminRolePermissionLists;
            $query = Menu::find()->select(['id', 'parent_id', 'name', 'url'])->where(['type' => Menu::MENU_TYPE_BACKEND]);
            $menuData =  Utils::tree_bulid($query->orderBy(['created_at' => SORT_ASC, 'sort' => SORT_ASC])                       
                        ->asArray()
                        ->all(), 'id', 'parent_id');
            $menuData = Menu::getMenuZtree($adminRolePermissionLists, $id, $menuData);

            return $menuData;
        }
    }

    protected function findModel($id)
    {
        if (($model = AdminRoles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAdminRolePermissionModel($id) {
        if (($model = AdminRolePermission::findOne($id)) !== null) {
            return $model;
        } else {
            return new AdminRolePermission();
        }        
    }
}
