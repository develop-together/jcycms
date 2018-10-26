<?php
/**
 * Author: yjc
 * Blog: https://blog.yjcweb.tk
 * Email: 2064320087@qq.com
 * Created at: 2018-04-28 10:06:00
 */

namespace api\components;

use Yii;
use yii\rest\Controller;
use common\components\Utils;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\filters\VerbFilter;


class BaseApiController extends Controller
{
    
    public $layout = false;

    public function init()
    {
        parent::init();
        // file_put_contents(Yii::getAlias('@api') . '/runtime/logs/vue_request_data.log', Json::encode(['time' => date('Y-m-d H:i:s'), 'method' => Yii::$app->getRequest()->getMethod(), 'data' => Utils::get_request_payload(), 'header' => Yii::$app->request->headers]). "\r\n-------\r\n", FILE_APPEND);
        return true;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['rateLimiter']);
        unset($behaviors['contentNegotiator']);
        
        return ArrayHelper::merge([
            'class' => SignatureFilter::className(),
            [
                'class' => ApiCors::className(),
                'cors' => [
                    'Origin' => [$_SERVER['HTTP_ORIGIN']],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Allow-Headers' => ['Origin', 'X-Requested-With', 'Content-Type', 'Accept', 'AppKey', 'Nonce', 'SignatureString', 'RequetTime']
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['GET'],
                    'logout' => ['GET'],
                    'article-list' => ['GET']
                ],
            ],
        ], $behaviors);
    }
}
