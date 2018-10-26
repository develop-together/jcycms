<?php 
 /**
 * Author: yjc
 * Blog: https://blog.yjcweb.tk
 * Email: 2064320087@qq.com
 * Created at: 2018-04-28 10:06:00
 */

namespace api\controller;

use Yii;
use api\models\User;

class UserController extends api\components\BaseApiController
{
	public function actionLogin()
	{
		if (Yii::$app->request->isPost) {
			$model = new User();
			$param = Yii::$app->request->post();
			var_dump($param);
		}
	}

	public function actionLogout()
	{

	}

	public function actionSignup()
	{
		
	}
}