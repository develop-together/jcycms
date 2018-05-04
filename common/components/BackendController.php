<?php 

namespace common\components;

use Yii;
use backend\models\User;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use yii\base\Event;

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
			return $this->redirect(['/public/login']);
		}
	}

	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		if (Yii::$app->user->isGuest) {
			exit('<script>window.top.location.href="' . Url::toRoute(['public/login']) . '"</script>');
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

    /**
     * 改变某个字段状态操作
     *
     * @param string $id
     * @param int $status
     * @param string $field
     * @return array|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionStatus($id, $status = 0, $field = 'status')
    {
        if (! $id) {
            throw new BadRequestHttpException(yii::t('app', "Id doesn't exit"));
        }

        $model = $this->findModel($id);
        $model->$field = $status;
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if(! $model->save(false)) {
                $errs = [];
                foreach ($model->getErrors() as $error) {
                    $errs[] = $error[0];
                }

                return ['code' => 300, 'message' => implode('<br>', $errs)];
            } else {
                return ['code' => 200, 'message' => '操作成功'];
            }
        } else {
            if (! $model->save()) {
                $errs = [];
                foreach ($model->getErrors() as $error) {
                    $errs[] = $error[0];
                }

                Yii::$app->session->setFlash('error', implode('<br>', $errs));
            }

            return $this->redirect(['index']);
        }
    }
}