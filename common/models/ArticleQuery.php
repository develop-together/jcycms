<?php

namespace common\models;

class ArticleQuery extends \yii\db\ActiveQuery
{

	public function article()
	{
		return $this->andOnCondition(['type' => Article::ARTICLE]);
	}

	public function photo()
	{
		return $this->andOnCondition(['type' => Article::PHOTOS_PAGE]);
	}

	public function singlePage()
	{
		return $this->andOnCondition(['type' => Article::SINGLE_PAGE]);
	}
}