<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{

    public $create_start_at;
    public $create_end_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'type', 'status', 'sort', 'user_id', 'scan_count', 'can_comment', 'visibility', 'flag_headline', 'flag_recommend', 'flag_slide_show', 'flag_special_recommend', 'flag_roll', 'flag_bold', 'flag_picture', 'created_at', 'updated_at'], 'integer'],
            [['title', 'sub_title', 'summary', 'thumb', 'seo_title', 'seo_keywords', 'seo_description', 'tag'], 'safe'],
            [['create_start_at', 'create_end_at', ], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['article'] = array_merge($scenarios['article'], [
            'create_start_at',
            'create_end_at',            
        ]);

        return $scenarios;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $type = self::ARTICLE)
    {
        $query = Article::find()->where(['type' => $type]);

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
        
        if (isset($getParams['pageSize'])) {
            $pageSize = $getParams['pageSize'];
        }
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
