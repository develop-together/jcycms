<?php
/**
 * Author: yjc
 * Blog: https://blog.yjcweb.tk
 * Email: 2064320087@qq.com
 * Created at: 2018-04-28 10:06:00
 */

namespace api\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use api\models\Article;
use api\components\SignatureFilter;
use common\components\Utils;
use yii\web\HttpException;
use api\components\ApiCors;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();
        file_put_contents(Yii::getAlias('@api') . '/runtime/logs/vue_request_data.log', Json::encode(['time' => date('Y-m-d H:i:s'), 'method' => Yii::$app->getRequest()->getMethod(), 'data' => Utils::get_request_payload(), 'header' => Yii::$app->request->headers]). "\r\n-------\r\n", FILE_APPEND);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'class' => SignatureFilter::className(),
            [
                'class' => ApiCors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Allow-Headers' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept', 'authKey']
                ]
            ]
        ]);
    }

    public function actionArticleList()
    {
        $models = Article::find()->all();
        
        return ArrayHelper::toArray($models);
    }

    public function actionArticleCreate()
    {
        return [];
     
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
