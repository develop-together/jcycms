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
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

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
                Yii::$app->session->setFlash('error', Yii::t('app', 'Illegal operation'));
                return $this->redirect('index');
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // TODO: 这里应该封装到model层
                // if ($postData['menuLists']) {
                //     $menuLists = explode(',', $postData['menuLists']);
                //     $delFlag = $this->deleteOldRolePermissions($id);
                //     foreach ($menuLists as $value) {
                //         $adminRolePermissionModel = $this->findAdminRolePermissionModel();
                //         $adminRolePermissionModel->role_id = $id;
                //         $adminRolePermissionModel->menu_id = $value;
                //         if (!$adminRolePermissionModel->save()) {
                //             $errors = [];
                //             foreach ($adminRolePermissionModel->errors as $error) {
                //                 $errors[] = $error[0];
                //             }

                //             throw new \yii\web\BadRequestHttpException(implode(",", $errors));
                //         }
                //     }
                // }
                if ($postData['rabcLists']) {
                    $diffA = $diffB = [];
                    $oldRabcLists = $postData['rabcLists'];
                    $permissionsFormat = $model->getPermissionsFormat();
                    $diffA = array_diff($postData['rabcLists'], $permissionsFormat);
                    $diffB = array_diff($permissionsFormat, $postData['rabcLists']);
                    if ($diffA && $diffB) {// 表示删除原来的同时新增
                        $postData['rabcLists'] = $diffA;
                        AdminRolePermission::deleteAll(['in', 'auth_id', $diffB]);
                    } elseif ($diffA) {// 表示只新增
                        $postData['rabcLists'] = $diffA;
                    } elseif ($diffB) {// 表示只删除
                        AdminRolePermission::deleteAll(['in', 'auth_id', $diffB]);
                        $postData['rabcLists'] = [];
                    }

                    if ($postData['rabcLists']) {
                        foreach ($postData['rabcLists'] as $key => $value) {
                            // $value = Json::decode($json, false);
                            $adminRolePermissionModel = $this->findAdminRolePermissionModel($value);
                            $adminRolePermissionModel->auth_id = $value;
                            $adminRolePermissionModel->role_id = $model->id;
                            if (!$adminRolePermissionModel->save()) {
                                $errors = [];
                                foreach ($adminRolePermissionModel->errors as $error) {
                                    $errors[] = $error[0];
                                }

                                throw new \yii\web\BadRequestHttpException(implode(",", $errors));
                            }
                        }
                    }
                }
                Yii::$app->cache->set('_permission_list_' . $model->id, $oldRabcLists);
                Yii::$app->session->setFlash('success', Yii::t('app', 'Success'));
                $transaction->commit();

                return $this->redirect(['assign', 'id' => $id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }

        $adminRolePermissionLists = [];
        $menuData = Menu::loadMenus($adminRolePermissionLists, $id);

        return $this->render('assign', [
            'model' => $model,
            'menuData' => $menuData
        ]);
    }

    private function deleteOldRolePermissions($role_id)
    {
        $adminRolePermissionModels = AdminRolePermission::find()->where(['role_id' => $role_id])->all();
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

            $menuData = Menu::loadMenus($adminRolePermissionLists, $id);

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

    protected function findAdminRolePermissionModel($authId = null)
    {
        if (($model = AdminRolePermission::find()->where(['auth_id' => $authId])->one()) !== null) {
            return $model;
        } else {
            return new AdminRolePermission();
        }
    }
}
