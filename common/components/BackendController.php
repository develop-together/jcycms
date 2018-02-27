<?php 

namespace common\components;

use Yii;

/**
* @author atuxe <atuxe@atuxe.com>
* @copyright Copyright (c) Boyuntong Inc. All rights reserved.
* @link http://www.boyuntong.com 
* @license http://www.boyuntong.com/licence
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
			return false;
		}

		return true;
	}
}