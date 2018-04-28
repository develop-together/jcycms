<?php 
/**
 * Author: yjc
 * Blog: https://blog.yjcweb.tk
 * Email: 2064320087@qq.com
 * Created at: 2018-04-28 10:06:00
 * Description: 跨域资源共享 CORS 机制允许一个网页的许多资源（例如字体、JavaScript等） 这些资源可以通过其他域名访问获取。 特别是JavaScript's AJAX 调用可使用 XMLHttpRequest 机制，由于同源安全策略该跨域请求会被网页浏览器禁止. CORS定义浏览器和服务器交互时哪些跨域请求允许和禁止。
 */

namespace api\components;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class ApiCors extends Cors
{
	public $cors = [
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => null,
        'Access-Control-Max-Age' => 86400,
        'Access-Control-Expose-Headers' => [],
        'Access-Control-Allow-Headers' => ['*'],
	];

	public function prepareHeaders($requestHeaders)
	{
		$responseHeaders = parent::prepareHeaders($requestHeaders);
        if (isset($this->cors['Access-Control-Allow-Headers'])) {
            $responseHeaders['Access-Control-Allow-Headers'] = implode(', ', $this->cors['Access-Control-Allow-Headers']);
        }	

		return $responseHeaders;
	}
}