<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2017-01-04 09:37
 */

namespace backend\components;

use yii\helpers\Json;

class Captcha extends \yii\captcha\Captcha {

	/**
	 * @inheritdoc
	 */
	public function registerClientScript() {
		$options = $this->getClientOptions();
		$options = empty($options) ? '' : Json::htmlEncode($options);
		$id = $this->imageOptions['id'];
		$view = $this->getView();
		CaptchaAsset::register($view);
		$view->registerJs("jQuery('#$id').yiiCaptcha($options);");
	}

}