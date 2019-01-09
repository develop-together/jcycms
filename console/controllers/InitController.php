<?php
namespace console\controllers;
use backend\models\User;
use backend\models\AdminRoles;
use backend\models\AdminRoleUser;
use common\models\Config;
use Yii;

class InitController extends \yii\console\Controller 
{
	/**
	 * Create init user
	 */
	public function actionCreateAdministrator() 
	{
		// header("content-type:text/html;charset=GB2312");
		echo "创建一个新管理员 ...\n"; // 提示当前操作
		$username = $this->prompt('User Name:'); // 接收用户名
		$email = $this->prompt('Email:'); // 接收Email
		$password = $this->prompt('Password:'); // 接收密码
		$model = new User(); // 创建一个新用户
		$model->setScenario('console_create');
		$model->username = $username; // 完成赋值
		$model->email = $email;
		$model->password = $password;
        $model->status = User::STATUS_ACTIVE;
		if (!$model->signUp()) {// 保存新的用户
			foreach ($model->getErrors() as $error) { 
				foreach ($error as $e) {
					echo "$e\n";
				}
			}

			return 1; // 命令行返回1表示有异常
		}

        $rolesModel = new AdminRoleUser();
        $rolesModel->role_id = 1;
		$rolesModel->user_id = $model->id;
        $rolesModel->save(false);
        echo '创建成功!';
        
		return 0; // 返回0表示一切OK
	}

	/**
	 * Create init config fields
	 */
	public function actionCreateConfig($scope='base')
	{
		echo "The fields required to create the config table...\n";
		$fieldLists = Yii::$app->params['configFileds'];
		$alreadVariables = array_keys(Config::loadData(true));
		$diffList = array_diff($fieldLists, $alreadVariables);
		if ($diffList) {
			foreach ($diffList as $filed) {
				$model = new Config();
				$model->scope = $scope;
				$model->variable = $filed;
				if (! $model->save()) {
					$errs = [];
					foreach ($model->errors as $error) {
						$errs[] = $error[0];
					}

					echo implode("\n", $errs);

					return 1;
				}
			}

			$this->stderr('Success');
			return 0;
		}

		$this->stderr('There is no need to build a new!');
		return 0;
	}

	public function actionTest()
	{
		$this->stderr('TEST');
	}
}
