<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PageArticle;

class PageSearch extends PageArticle
{

    public function rules()
    {
        return [
             [['id', 'sort', 'created_at', 'updated_at'], 'integer'],
             [['type', 'title', 'sub_title'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = PageSearch::find()->singlePage()->with('category');
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

        if (isset($getParams['pageSize'])) {
            $pageSize = $getParams['pageSize'];
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
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'status' => $this->status,
            'sort' => $this->sort,
            'user_id' => $this->user_id,
            'scan_count' => $this->scan_count,
            'can_comment' => $this->can_comment,
            'visibility' => $this->visibility,
            'flag_headline' => $this->flag_headline,
            'flag_recommend' => $this->flag_recommend,
            'flag_slide_show' => $this->flag_slide_show,
            'flag_special_recommend' => $this->flag_special_recommend,
            'flag_roll' => $this->flag_roll,
            'flag_bold' => $this->flag_bold,
            'flag_picture' => $this->flag_picture,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'thumb', $this->thumb])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keywords', $this->seo_keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}