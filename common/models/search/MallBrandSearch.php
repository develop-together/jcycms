<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MallBrand;

/**
 * MallBrandSearch represents the model behind the search form about `common\models\MallBrand`.
 */
class MallBrandSearch extends MallBrand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name', 'brand_code', 'image', 'letter'], 'safe'],
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
        $query = MallBrand::find();

        // add conditions that should always apply here

        $this->load($params);

        $pageSize = 10;
        $pageCurrent = 0;
        $field = 'id';
        $sort = SORT_DESC;
        $getParams = Yii::$app->request->getQueryParams();
        $pageCurrent = 0;
        if (isset($getParams['page'])) {
            $pageCurrent = $getParams['page'] - 1;
        }
        /*if (isset($params['pageSize'])) {
            $pageSize = $params['pageSize'];

            $pageCurrent = $params['pageCurrent']-1;

            if (in_array(($params['orderField']), ['id', 'created_at', 'updated_at', 'created_at_format', 'created_at_format'])) {
                $field = $params['orderField'];
            }

            if (strtolower($params['orderDirection']) == 'asc') {
                $sort = SORT_ASC;
            }
        }*/

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
                'page' => $pageCurrent,
            ],
            'sort' =>[
                'defaultOrder' =>[
                    'letter' => SORT_ASC,
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
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'brand_code', $this->brand_code])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'letter', $this->letter]);

        return $dataProvider;
    }
}
