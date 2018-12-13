<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\helpers;

use yii\helpers\Html AS CommonHtml;

class Html extends CommonHtml
{
	public static function imagePicker($name, $selection = null, $items = [], $options = [], $imgSrc = [])
	{
		$options = array_merge($options, ['class' => 'form-control image-picker', 'options' => $imgSrc]);

		return parent::dropDownList($name, $selection, $items, $options);
	}	
}
