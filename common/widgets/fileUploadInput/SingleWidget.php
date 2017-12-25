<?php 
	namespace common\widgets\fileUploadInput;

	use yii\helpers\Html;
	use yii\helpers\Json;	

	class SingleWidget extends MultipleWidget
	{
		public $multiple = false;

		public $maxFileSize = 0;

		public $maxNumberOfFiles = 1;

		public function registerClientScript()
		{
			parent::registerClientScript();
		}
	}	