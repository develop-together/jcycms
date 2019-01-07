<?php

namespace backend\controllers;

use Yii;
use common\models\Config;
use yii\data\ActiveDataProvider;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use common\components\Utils;
use common\components\BaseMail;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends BackendController
{

    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            if (Config::updateData()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Error'));
            }
        }

        $config = Config::loadData(true);
        $logo = Config::findOne(['variable' => 'system_logo', 'scope' => 'base']);

        return $this->render('index', [
            'config' => $config,
            'logo' => $logo,
        ]);
    }

    public function actionContent()
    {
        if (Yii::$app->request->isPost) {
            if (Config::updateData()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['config/content']);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Error'));
            }
        }

        $config = Config::loadData(true);

        return $this->render('content', [
            'config' => $config,
        ]);
    }

    public function actionSmtp()
    {
        if (Yii::$app->request->isPost) {
            if (Config::updateData()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['config/smtp']);
            } else {
                Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Error'));
            }
        }

        $config = Config::loadData(true);

        return $this->render('smtp', [
            'config' => $config,
        ]);
    }

    public function actionTestEmail()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $get = Yii::$app->request->get();
            if (empty($get['email']) || !Utils::email($get['email'])) {
                return ['statusCode' => 300, 'message' => Yii::t('app', 'Please Enter The Correct Mailbox Format')];
            }

            $number = date('His');
            try {
                $result = BaseMail::send($get['email'], Yii::t('app', 'Test Email({email})', ['email' => $get['email']]), Yii::t('app', 'Test Number:{number} .This is a test mail. When you receive this mail, it indicates that your sending mailbox is configured correctly.', ['number' => $number]));
                if ($result[0]) {
                    return ['statusCode' => 200, 'message' => Yii::t('app', 'A test email numbered {number} has been sent to mailbox {email}. Please check it.', ['number' => $number, 'email' => $get['email']])];
                } else {
                    return ['statusCode' => 300, 'message' => $result[1]];
                }
            } catch(\Expression $e) {
                 return ['statusCode' => 300, 'message' => $e->getMessage()];
            }

        }
    }

    /**
     * Displays a single Config model.
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
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Config();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
