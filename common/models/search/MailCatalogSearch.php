<?php
declare(strict_types=1);
/**
 * Created by PhpStorm
 * User: Administrator
 * Author: JieChengYang
 * Date: 2020/3/16
 * Time: 20:15
 */

namespace common\models\search;

use Yii;
use common\components\BaseConfig;
use common\models\MallCategory;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;

class MailCatalogSearch extends  MallCategory
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
        $query = MallCategory::find()->product();

        // add conditions that should always apply here

        $this->load($params);

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