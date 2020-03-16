<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Category;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CategorySearch represents the model behind the search form about `common\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name', 'remark'], 'safe'],
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
     * @return ArrayDataProvider
     */
    public function search($params)
    {
        $query = Category::find()->article();
        $this->load($params);

        if ($this->name) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }

        $query->orderBy(['sort' => SORT_ASC]);
        $lists = $query->all();
        $menuTree = ArrayHelper::index($this->childesToObject($lists, 0), 'id');

        $dataProvider = new ArrayDataProvider([
            'allModels' => $menuTree,
            'pagination' => [
                'pageSize' => -1,
            ],
        ]);

        return $dataProvider;
    }
}
