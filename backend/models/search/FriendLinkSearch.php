<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FriendLink;

/**
 * FriendLinkSearch represents the model behind the search form about `common\models\FriendLink`.
 */
class FriendLinkSearch extends FriendLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'created_at', 'updated_at', 'user_id'], 'integer'],
            [['name', 'image', 'url', 'target', 'status'], 'safe'],
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
        $query = FriendLink::find();

        // add conditions that should always apply here

        $this->load($params);

        $pageSize = 10;
        $pageCurrent = 0;
        $field = 'id';
        $sort = SORT_DESC;

        // if (isset($params['pageSize'])) {
        //     $pageSize = $params['pageSize'];

        //     $pageCurrent = $params['pageCurrent']-1;

        //     if (in_array(($params['orderField']), ['id', 'create_time', 'update_time', 'create_time_format', 'update_time_format'])) {
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
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
