<?php
namespace console\controllers;
use backend\models\User;

class InitController extends \yii\console\Controller {
	/**
	 * Create init user
	 */
	public function actionCreateAdministrator() {
		echo "创建一个新用户 ...\n"; // 提示当前操作
		$username = $this->prompt('User Name:'); // 接收用户名
		$email = $this->prompt('Email:'); // 接收Email
		$password = $this->prompt('Password:'); // 接收密码
		$model = new User(); // 创建一个新用户
		$model->setScenario('create');
		$model->username = $username; // 完成赋值
		$model->email = $email;
		$model->password = $password;
		$user->setPassword($this->password);
		if (!$model->signUp()) // 保存新的用户
		{
			foreach ($model->getErrors() as $error) // 如果保存失败，说明有错误，那就输出错误信息。
			{
				foreach ($error as $e) {
					echo "$e\n";
				}
			}

			return 1; // 命令行返回1表示有异常
		}

		return 0; // 返回0表示一切OK
	}
}
