<?php

namespace common\modules\attachment\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AttachmentSearch extends Attachment
{

    public function search($params)
    {
        $query = Attachment::find();

        // add conditions that should always apply here

        $this->load($params);

        $pageSize = 10;
        $pageCurrent = 0;
        $field = 'id';
        $sort = SORT_DESC;

        if (isset($params['page'])) {
            $pageCurrent = $params['page'] - 1;
        }

        if (isset($params['pageSize'])) {
            $pageSize = $params['pageSize'];
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
        ]);

        return $dataProvider;
    }
}