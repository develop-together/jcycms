<?php
/**
 * Author: yjc
 * Blog: https://blog.yjcweb.tk
 * Email: 2064320087@qq.com
 * Created at: 2018-04-28 10:06:00
 */

namespace api\controllers;

use Yii;
use api\components\BaseApiController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use api\models\Article;
use backend\models\User;
use common\components\Utils;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * Site controller
 */
class SiteController extends BaseApiController
{

    public function behaviors()
    {
        return parent::behaviors();
    }

    public function actionArticleList()
    {
        $query = Article::find();
        $getParams = Yii::$app->getRequest()->getQueryParams();
        file_put_contents(Yii::getAlias('@api') . '/runtime/logs/vue_request_data.log', json_encode($getParams));
        $pageSize = isset($getParams['pageSize']) ? $getParams['pageSize'] : 2;
        $pageCurrent = isset($getParams['pageCurrent']) ? $getParams['pageCurrent'] : 0;// - 1
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $pageCurrent,
            ],
            'sort' =>[
                'defaultOrder' =>[
                    'created_at' => SORT_DESC,
                ],
            ],
        ]);         
        $totalCount = $dataProvider->getTotalCount();
        // $pageCount = ceil($totalCount / $pageSize);

        return ArrayHelper::toArray([
            'totals' => $totalCount,
            'pageCurrent' => $pageCurrent,
            'pageSize' => $pageSize,
            'da' => $dataProvider->getModels()
        ]);
    }

    public function actionArticleCreate()
    {
        if (Yii::$app->request->isPost) {
            $model = new Article();
            $params = Yii::$app->request->post();
            $attributes = Json::decode($params['article'], true);
            $model->attributes = $attributes;
            $model->type = Article::ARTICLE;
            $model->user_id = User::SUPER_MANAGER;
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!$model->save()) {
                    $errors = [];
                    foreach ($model->errors as $error) {
                        $errors[] = $error[0]; 
                    }
                    throw new \yii\web\BadRequestHttpException(implode(",", $errors));
                }  
                $transaction->commit();
                
                return ['message' => '操作成功']; 
            } catch(\Expression $e) {
                $transaction->rollBack();
                Yii::$app->getResponse()->statusCode = 400;
                return ['message' => $e->getMessage()]; 
            }
         
        }

        Yii::$app->getResponse()->statusCode = 500;

        return yii::$app->getResponse()->send();
     
    }

    /**
     * 网站进入维护模式时
     * 即在后台网站设置中关闭了网站执行此操作
     *
     */
    public function actionOffline()
    {
        Yii::$app->getResponse()->statusCode = 503;
        Yii::$app->getResponse()->content = "sorry, the site is temporary unserviceable";
        Yii::$app->getResponse()->send();
    }


    /**
     * 切换网站视图
     * 请开发其他网站视图模版，并参照yii2文档配置
     *
     */
    public function actionView()
    {
        $view = Yii::$app->getRequest()->get('type');
        if (isset($view)) {
            Yii::$app->session['view'] = $view;
        }
        $this->goBack( Yii::$app->getRequest()->getHeaders()->get('referer') );
    }

    /**
     * 切换语言版本
     *
     */
    public function actionLanguage()
    {
        $language = Yii::$app->getRequest()->get('lang');
        if (isset($language)) {
            Yii::$app->session['language'] = $language;
        }
        $this->redirect( Yii::$app->getRequest()->getHeaders()->get('referer') );
    }

    /**
     * http异常捕捉后处理
     *
     * @return string
     */
    public function actionError()
    {
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $code = $exception->statusCode;
        } else {
            $code = $exception->getCode();
        }

        $name = $exception->getName();
        if ($code) {
            $name .= " (#$code)";
        }

        $message = $exception->getMessage();

        $statusCode = $exception->statusCode ? $exception->statusCode : 500;
        if (Yii::$app->getRequest()->getIsAjax()) {
            return "$name: $message";
        } else {
            return $this->render('error', [
                'code' => $statusCode,
                'name' => $name,
                'message' => $message,
                'exception' => $exception,
            ]);
        }
    }

}
