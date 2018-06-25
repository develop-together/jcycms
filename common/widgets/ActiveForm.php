<?php 
/**
 * @author: yjc
 * @email: 2064320087@qq.com
 * Created at: 2018-06-25 22:47
 */

namespace common\widgets;

use Yii;

class ActiveForm extends \yii\widgets\ActiveForm 
{

	public $options = [
		'class' => 'form-horizontal'
	];

	public $fieldClass = 'common\widgets\ActiveField';

	public $fieldConfig = [
		'template' =>"{label}\n<div class=\"col-sm-10\">{input}\n{error}</div>\n{hint}",
	    'labelOptions' => ['class' => 'col-sm-2 control-label'],
	    'options' => ['class' => 'form-group'],    
	    'inputOptions' => ['class' => 'form-control'],
	    'errorOptions' => ['class' => 'help-block m-b-none'],                            
	];
}