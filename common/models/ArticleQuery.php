<?php

namespace common\models;

class ArticleQuery extends \yii\db\ActiveQuery
{
	public function init()
	{
		$this->andOnCondition(['type' => Article::ARTICLE]);
		parent::init();
	}
}