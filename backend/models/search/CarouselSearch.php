<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Carousel;

/**
 * CarouselSearch represents the model behind the search form about `common\models\Carousel`.
 */
class CarouselSearch extends Carousel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['key', 'title'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Carousel::find();

        // add conditions that should always apply here

        $this->load($params);

        $pageSize = 10;
        $pageCurrent = 0;
        $field = 'id';
        $sort = SORT_DESC;

        // if (isset($params['pageSize'])) {
        //     $pageSize = $params['pageSize'];

        //     $pageCurrent = $params['pageCurrent']-1;

        //     if (in_array(($params['orderField']), ['id', 'created_at', 'updated_at', 'created_at_format', 'created_at_format'])) {
        //         $field = $params['orderField'];
        //     }

        //     if (strtolower($params['orderDirection']) == 'asc') {
        //         $sort = SORT_ASC;
        //     }
        // }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $pageCurrent,
            ],
            'sort' =>[
                'defaultOrder' =>[
                    $field => $sort,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
