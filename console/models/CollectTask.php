<?php
namespace console\models;

use Yii;

class CollectTask extends \common\models\CollectTask
{
	
	public function getUrls()
	{
		$models = self::find()
			->select(['url'])
			->where(['status' => \common\components\BaseConfig::Status_Enable])
			->all();
		$urls = [];
		if ($models) {
			foreach ($models as $model) {
				$urls[] = $model->url;
			}
		}

		return $urls;
	}	
}