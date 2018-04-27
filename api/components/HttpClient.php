<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\components;

use Yii;
use yii\httpclient\Client;
use yii\web\Request;
use yii\web\Response;
use common\models\UserIotApi;
use api\models\UserAccessToken;
use yii\helpers\ArrayHelper;

class HttpClient extends Client
{
    /**
     * @param string|array $url
     * @param null $data
     * @param array $headers
     * @param array $options
     * @return \yii\httpclient\Request
     */
    public function get($url, $data = null, $headers = [], $options = [])
    {
        return parent::get($url, $this->signatureData($data), $headers, $options);
    }

    /**
     * @param string|array $url
     * @param null $data
     * @param array $headers
     * @param array $options
     * @return \yii\httpclient\Request
     */
    public function post($url, $data = null, $headers = [], $options = [])
    {
        return parent::post($url, $this->signatureData($data), $headers, $options);
    }

    public function signatureData($data)
    {
        unset($data['_sign']);
        // $apiInfo = UserIotApi::findOne(['user_id' => 2]);
        $apiInfo = self::getApiInfo();

        $data['_key'] = $apiInfo->app_key;
        $data['_time'] = time();
        $data['_nonce'] = Yii::$app->security->generateRandomString();

        ksort($data);
        $normalized = array();
        foreach($data as $key => $val)
        {
            $normalized[] = $key."=".$val;
        }

        $signData = implode("&", $normalized);
        $data['_sign'] = hash_hmac(Yii::$app->params['algo'], $signData, $apiInfo->app_secret, false);
        
        return $data;
    }

    public function afterSend($request, $response)
    {
        parent::afterSend($request, $response);
        // var_dump($response->getContent());exit;
        $appResponse = Yii::$app->getResponse();
        $data = $response->getData();
        if (!is_array($data) || !isset($data['statusCode']) || $data['statusCode'] != 200) {
            $appResponse->setStatusCode(400);
        }
        $appResponse->data = isset($data['data']) ? $data['data'] : $data;
    }

    public static function getApiInfo()
    {
        $params = ArrayHelper::merge(yii::$app->request->getQueryParams(), yii::$app->request->getBodyParams());
        $userAccessToken = UserAccessToken::findOne(['access_token' => $params['access-token'], 'app_key' => $params['_key']]);
        if (!$userAccessToken) {
            return $this->responseJson('Token 失效或过期');
        }

        $apiInfo = UserIotApi::findOne(['user_id' => $userAccessToken->user_id]);
        if (!$apiInfo) {
            return $this->responseJson('未查询到相关信息！');
        }

        return $apiInfo;
    }
}