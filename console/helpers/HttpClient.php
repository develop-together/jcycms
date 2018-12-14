<?php 
namespace console\helpers;

use Yii;
use yii\httpclient\Client;
use yii\web\Request;
use yii\web\Response;
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
        return parent::get($url, $data, $headers, $options);
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
        return parent::post($url, $data, $headers, $options);
    }	
}