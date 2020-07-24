<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MallSpu;

/**
 * MallSpuSearch represents the model behind the search form about `common\models\MallSpu`.
 */
class MallSpuSearch extends MallSpu
{

    /**
     * 商品分类深度
     * @var string
     */
    public $catalog_path = '';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cid1', 'cid2', 'cid3', 'brand_id', 'flag_saleable', 'flag_valid', 'sort', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['spu_code', 'title', 'sub_title', 'brand_name', 'dim', 'image_ids'], 'safe'],
            [['weight'], 'number'],
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
        $query = MallSpu::find();

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
            'sort' => [
                'defaultOrder' => [
                    $field => $sort,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when flag_validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $this->computedCid();
//        $query->andFilterWhere(['=', 'cid1', $this->cid1])
//            ->orFilterWhere(['=', 'cid2', $this->cid2])
//            ->orFilterWhere(['=', 'cid3', $this->cid3]);
//        if ($this->cid1) {
//            $query->andWhere(['cid1' => $this->cid1]);
//            if ($this->cid2) {
//                $query->orWhere(['cid2' => $this->cid2]);
//                if ($this->cid3) {
//                    $query->orWhere(['cid3' => $this->cid3]);
//                }
//            }
//        } elseif ($this->cid2) {
//            $query->andWhere(['cid2' => $this->cid2]);
//            if ($this->cid3) {
//                $query->orWhere(['cid3' => $this->cid3]);
//            }
//        } elseif ($this->cid3) {
//            $query->andWhere(['cid3' => $this->cid3]);
//        }

        if ($this->cid3) {
            $this->cid1 = $this->cid2 = null;
            $query->andWhere(['cid3' => $this->cid3]);
        }

        if ($this->cid2) {
            $this->cid1 = null;
            $query->andWhere(['cid2' => $this->cid2]);
        }

        if ($this->cid1) {
            $query->andWhere(['cid1' => $this->cid1]);
        }

        $this->catalog_path = implode(',', array_filter([$this->cid1, $this->cid2, $this->cid3]));
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'weight' => $this->weight,
            'flag_saleable' => $this->flag_saleable,
            'flag_valid' => $this->flag_valid,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'spu_code', $this->spu_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'brand_name', $this->brand_name])
            ->andFilterWhere(['like', 'dim', $this->dim])
            ->andFilterWhere(['like', 'images', $this->images]);

//        echo $query->createCommand()->getRawSql();
//        exit;
        return $dataProvider;
    }
}
