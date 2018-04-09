<?php 

namespace common\components;

use Yii;
use backend\models\User;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;

/**
* @author yjc <2064320087@qq.com>
* @copyright Copyright (c) JcyCms Inc. All rights reserved.
* @link https://www.cnblogs.com/YangJieCheng/ 
* @version 1.0.0
*/
class BackendController extends BaseController
{
 
	public function init()
	{
		parent::init();

		if (Yii::$app->user->isGuest) {
			return $this->redirect(['/site/login']);
		}
	}

	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if (Yii::$app->user->isGuest) {
			exit('<script>window.top.location.href="' . Url::toRoute(['site/login']) . '"</script>');
			// return false;
		}

		if (Yii::$app->user->id == User::SUPER_MANAGER) {
			return true;
		}

		/**
		 * 权限检查
		 * @var [type]
		 */		
		
		try {
			// in_array($action->id, ['index', 'create', 'update', 'delete', 'view']) && 
			if (!UserAcl::hasAcl($this->id . '/' . $action->id)) {
                if (yii::$app->request->isAjax) {
                    yii::$app->getResponse()->content = json_encode(['code' => 1001, 'message' => yii::t("app", "Permission denied")]);
                    yii::$app->getResponse()->send();	
                } else {
                	$error = '<div class="ibox-title"><strong>' . yii::t("app", "Permission denied") . '</strong>';
                	if ($action->id != 'assignment') {
                		$error .= '<<<a style="text-decoration: none;cursor:pointer;color:#1ab394" href="'. Url::toRoute([Yii::$app->controller->id . '/index']) .'">返回</a>>>';
                	}
                	 
                	throw new ForbiddenHttpException($error . '</div>');
                }
				
			}
		} catch(\Exception $ex) {
			exit($ex->getMessage());
		}

		return true;
	}
}