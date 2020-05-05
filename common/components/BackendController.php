<?php

namespace common\components;

use Yii;
use backend\models\User;
use backend\models\AdminRoles;
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
    public $page = 1;

	public function init()
	{
		parent::init();

		// if (Yii::$app->user->isGuest) {
		// 	return $this->redirect(['/public/login']);
		// }

        $this->page = Yii::$app->request->get('page');
	}

	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

//		if (Yii::$app->user->isGuest) {
//			exit('<script>window.top.location.href="' . Url::toRoute(['public/login']) . '"</script>');
//			// return false;
//		}

        $user = Yii::$app->user->identity;
        if ((int)$user->userRole->role->id === AdminRoles::SUPER_ROLE_ID) {
            return true;
        }
        
		/**
		 * 权限检查
		 * @var [type]
		 */
		try {
            $route = $this->route . ':' . strtoupper(Yii::$app->request->getMethod());
			if (!UserAcl::hasAcl($route)) {
                if (yii::$app->request->isAjax) {
                    yii::$app->getResponse()->content = json_encode(['statusCode' => 300, 'code' => 1001, 'message' => Yii::t("app", "Permission denied"), 'stateInfo' => Yii::t("app", "Permission denied")]);
                    return yii::$app->getResponse()->send();
                } else {
                	$error = '<div class="ibox-title"><strong>' . Yii::t("app", "Permission denied") . '</strong>';
                	if ($action->id != 'assignment') {
                	    // TODO: 考虑有module的时候
                		$error .= '<<<a style="text-decoration: none;cursor:pointer;color:#1ab394" href="'. Url::toRoute([Yii::$app->controller->id . '/' . (Yii::$app->controller->action->id ? Yii::$app->controller->action->id : 'index')]) .'">' . Yii::t('app', 'Back') .'</a>>>';
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
            throw new BadRequestHttpException(Yii::t('app', "Id doesn't exit"));
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

    public function redirect($url, $statusCode = 302)
    {
        $route = (is_array($url) && in_array('index', $url) && $this->page > 1) ? Url::to(array_merge($url, ['page' => $this->page])) : Url::to($url);
        return Yii::$app->getResponse()->redirect($route, $statusCode);
    }
}