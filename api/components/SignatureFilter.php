<?php
/**
 * @author Atuxe <atuxe@atuxe.com>
 */

namespace api\components;

use Yii;
use yii\base\ActionFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;

class SignatureFilter extends ActionFilter
{
    private $_params;
    public $timeOut;
    public $algo;

    public function init()
    {
        parent::init();
        if ($this->timeOut === null ) {
            $this->timeOut = Yii::$app->params['requestTimeOut'];
        }
        
        if ($this->algo === null ) {
            $this->algo = Yii::$app->params['algo'];
        }
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $params = $this->getParams();
        // 参数完整性验证
        if (!isset($params['_key'])
            || !isset($params['_sign'])
            || !isset($params['_time'])
            || !isset($params['_nonce'])
            || strlen($params['_nonce']) !== 32
            || !is_numeric($params['_time'])
        ) {
            throw new BadRequestHttpException('请求参数不全, 或参数不规范');
        }

        if(Yii::$app->params['app_key'] !== $params['_key']) {
             $this->callback(['message' => '非法的app_key'], 'error');
        }

        if (!isset($params['_time']) || $this->getIsTimeOut($params['_time'])) {
            throw new BadRequestHttpException('请求超时');
        }

        $requestSignature = $params['_sign'];
        $requestSignature = str_replace(' ', '+', $requestSignature);
        // 签名验证
        $toSignString = $this->getNormalizedString($params);
        $signature = $this->getSignature($toSignString, Yii::$app->params['app_secret']);
        if ($requestSignature != $signature) {
            throw new BadRequestHttpException('签名错误' );
        }

        return true;
    }

    public function checkTime() {

    }

    public function checkSignature() {

    }

    public function getIsTimeOut($time) {
        return abs($time - time()) > $this->timeOut;
    }

    public function getParams() {
        if ($this->_params === null) {
            $request = Yii::$app->getRequest();
            $this->_params = ArrayHelper::merge(
                $request->getQueryParams(),
                $request->getBodyParams(),
                $request->getHeaders()
            );
        }

        return $this->_params;
    }

    public function getNormalizedString($params)
    {
        if (isset($params['_sign'])) {
            unset($params['_sign']);
        }
        ksort($params);
        $normalized = array();
        foreach($params as $key => $val)
        {
            $normalized[] = $key."=".$val;
        }

        return implode("&", $normalized);
    }

    function getSignature($str, $key)
    {
        // return base64_encode(hash_hmac($this->algo, $str, $key, true));
        return hash_hmac($this->algo, $str, $key, false);
    }
}