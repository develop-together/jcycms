<?php 

namespace common\modules;

use Yii;
use yii\base\Event;

class Module extends \yii\base\Module
{
	public function init()
	{
		parent::init();

		$class = new \ReflectionClass($this);

		if (Yii::$app->id = 'app-backend') {
			$this->controllerNamespace = $class->getNamespaceName() . '\\backend\\controllers';
			$this->viewPath = $this->basePath . '\\backend\\views';
		}
	}
}
