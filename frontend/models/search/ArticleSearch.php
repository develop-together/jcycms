<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 10:37:36
 */
namespace frontend\models\search;

use Yii;
use frontend\models\Article;
use yii\data\ActiveDataProvider;
use common\components\BaseConfig;

class ArticleSearch extends Article
{
	public function rules()
	{
		return [
			['title', 'string', 'length' => 255],
			['category_id', 'integer']
		];
	}

	public function search($params, $cat = '')
	{

		// ->joinWith('articleContents')
		$query = self::find()
			->with(['category', 'user', 'articleContent']);
		$this->load($params);

		$pageSize = isset($params['pageSize']) ? intval($params['pageSize']) : 5;
		$pageCurrent = isset($params['pageCurrent']) ? intval($params['pageCurrent']) - 1 : 0;
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageParam' => 'pageCurrent',
				'pageSizeParam' => 'pageSize',
				'pageSize' => $pageSize,
				'page' => $pageCurrent
			],
			'sort' => [
				'defaultOrder' => [
					'sort' => SORT_ASC,
					'created_at' => SORT_DESC
				]
			]
		]);

		if (! $this->validate()) {
			return $dataProvider;
		}

		if (!empty($cat)) {
			$query->andWhere(['category_id' => $cat]);
		}

		if(isset($params['flag_recommend']))
			$query->andWhere(['flag_recommend' => $params['flag_recommend']]);

		if(isset($params['flag_special_recommend']))
			$query->andWhere(['flag_special_recommend' => $params['flag_special_recommend']]);

		$query->andFilterWhere(['like', 'title', $this->title]);
		return $dataProvider;

	}
}