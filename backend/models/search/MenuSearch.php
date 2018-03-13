<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Menu;

/**
 * MenuSearch represents the model behind the search form about `backend\models\Menu`.
 */
class MenuSearch extends Menu
{
    public $searchType = 1;

    /**
     * @inheritdoc
     */ 
    public function rules()
    {
        return [
            [['id', 'type', 'parent_id', 'sort', 'is_absolute_url', 'is_display', 'method', 'created_at', 'updated_at'], 'integer'],
            [['name', 'url', 'icon', 'target'], 'safe'],
        ];
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
        $query = Menu::find();

        // add conditions that should always apply here

        $this->load($params);

        $pageSize = 30;
        $pageCurrent = 0;
        $field = 'id';
        $sort = SORT_ASC;

        if (isset($params['pageSize'])) {
            $pageSize = $params['pageSize'];

            $pageCurrent = $params['pageCurrent']-1;

            if (in_array(($params['orderField']), ['id', 'create_time', 'update_time', 'create_time_format', 'update_time_format'])) {
                $field = $params['orderField'];
            }

            if (strtolower($params['orderDirection']) == 'desc') {
                $sort = SORT_DESC;
            }
        }

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
                'pageSize' => $pageSize,
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
            'type' => $this->type,
            'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'is_absolute_url' => $this->is_absolute_url,
            'is_display' => $this->is_display,
            'method' => $this->method,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        if ($this->searchType == 1) {
            $query->andFilterWhere(['type' => self::MENU_TYPE_BACKEND]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'target', $this->target]);

        return $dataProvider;
    }
}