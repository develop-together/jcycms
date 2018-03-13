<?php 
 namespace common\components;
 
 use yii\helpers\Json;
/**
* 借口类
* @author atuxe <atuxe@boyuntong.com>
*/
 class BaseApi 
 {
 	public static function instance()
 	{
 		return new self();
 	}

 	public function getClients()
 	{
 		return [
			'handicap_app' => [
				'app_key' => '8e43682d28fdc79c',
				'secret' => 'bb47324b8a618e4e',
			],
 		];
 	}

	/**
	 * 检查API请求是否正确
	 * @param  array  $params 参数
	 * @return bool         
	 */
	public function checkParams($params = [])
	{
		if (!isset($params['sig']) || !isset($params['app_key'])) {
			return false;
		}
		
		$sig = $params['sig'];
		$appKey = $params['app_key'];
		unset($params['sig']);
		foreach ($this->getClients() as $name => $client) {
			$params['app_key'] = $client['app_key'];
			if ($appKey == $client['app_key'] && $sig == $this->getSignature($params, [], $client['secret'])) {
				return true;
			}
		}
		return false;
	}

	/**
     * 根据参数生成签名
     * @param  array  $params 参数
     * @param  array $exception 不加入签名的字段
     * @param  string $secret 密钥
     * @return string         签名
     */
    public function getSignature($params, $exception=array(), $secret='')
    {
        empty($secret) && $secret = self::SECRET;
        !isset($params['app_key']) && $params['app_key'] = self::APP_KEY;
        if (count($exception) > 0) {
            foreach ($exception as $key) {
                unset($params[$key]);
            }
        }
        ksort($params);
        $str = '';
        foreach ($params as $key => $value) {
            $str .= $key . '=' . $value;
        }

        return md5($str . $secret);
    }

	public function getErrorByCode()
    {
        return [
            '1' => '操作成功',
            '10' => '服务器繁忙',
            '100' => '缺少必要参数，没有传必须参数',
            '103' => '参数错误，应该传正整数，比如id传成了负数',
            '150' => 'app_key未知',
            '160' => '签名错误，可能sig算错了',
            '170' => 'token无效，比如输错了',
            '171' => 'token过期了',
            '310' => '用户不存在',
            '311' => '密码错误',
            '317' => '用户被封禁',
        ];
    }

    /**
     * 返回信息客户端
     * @param  integer  $code 
     * @param  array 	$params 附加字段
     * @return        
     */
    public function callback($code = 1, $params = [])
    {
    	$errors = $this->getErrorByCode();
    	echo Json::encode(array_merge([
    		'result' => $code,
    		'message' => $errors[$code],
    	], $params));
    	Yii::$app->end();
    } 	
 }