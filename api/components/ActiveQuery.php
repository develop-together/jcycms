<?php 
 namespace api\components;

 use Yii;
 use yii\db\ActiveQuery as BaseQuery;

 class ActiveQuery extends BaseQuery
 {
 	public function init()
 	{
 		parent::init();
 		
 		$model = Yii::createObject($this->modelClass);
 		$formName = $model->formName();
 		if ($formName === 'Article') {
 			$this->andCondition(['type' => $model::ARTICLE]);
 		}
 	}
 }