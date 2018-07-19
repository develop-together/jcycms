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
use yii\helpers\Url;

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
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
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
                yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));

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
                yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));

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
        if (Yii::$app->request->isPost && $postData = Yii::$app->request->post()) {
            if ($model->id == AdminRoles::SUPER_ROLE_ID) {
                Yii::$app->session->setFlash('error', "非法操作");
                return $this->redirect('index');
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                
                if ($postData['menuLists']) {
                    $menuLists = explode(',', $postData['menuLists']);
                    $delFlag = $this->deleteOldRolePermissions($id);
 /*                   if (!$delFlag) {
                        Yii::$app->session->setFlash('error', "操作失败");
                    }*/

                    foreach ($menuLists as $value) {
                        $adminRolePermissionModel = $this->findAdminRolePermissionModel();
                        $adminRolePermissionModel->role_id = $id;
                        $adminRolePermissionModel->menu_id = $value;
                        if (!$adminRolePermissionModel->save()) {
                            $errors = [];
                            foreach ($adminRolePermissionModel->errors as $error) {
                                $errors[] = $error[0];
                            }

                            throw new \yii\web\BadRequestHttpException(implode(",", $errors));
                        }
                    }
                } 
                Yii::$app->session->setFlash('success', "操作成功");
                $transaction->commit();

                return $this->redirect(['assign', 'id' => $id]);
            } catch(\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }
        
        return $this->render('assign', [
            'model' => $model,
        ]);
    }

    private function deleteOldRolePermissions($role_id)
    {
        $adminRolePermissionModels = AdminRolePermission::find() ->where(['role_id' => $role_id]) ->all();
        $tmp = 0;
        if (!$adminRolePermissionModels) {
            return $tmp;
        }

        foreach ($adminRolePermissionModels as $key => $model) {
            $model->delete() && $tmp++;
        }

        return $tmp;
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
            $query = Menu::getBackendQuery();
            $menuData =  Utils::tree_bulid($query->orderBy(['sort' => SORT_ASC])                       
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

    protected function findAdminRolePermissionModel($id=0) {
        if (($model = AdminRolePermission::findOne($id)) !== null) {
            return $model;
        } else {
            return new AdminRolePermission();
        }        
    }
}
