<?php

namespace common\models;

use backend\helpers\Html;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_spec_group}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 */
class MallSpecGroup extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_spec_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'cid' => Yii::t('mall', 'Category'),
            'name' => Yii::t('mall', 'Group Name'),
        ]);
    }

    public function getCategory()
    {
        return $this->hasOne(MallCategory::class, ['id' => 'cid']);
    }

    public static function loadData()
    {
        $models = self::find()->select(['id', 'name'])
            ->where(1)
            ->asArray()
            ->all();

        return ArrayHelper::map($models, 'id', 'name');
    }

    public static function loadGroupAttributes($cid = null)
    {
        $models = self::find()
            ->select(['id', 'cid', 'name'])
            ->andFilterWhere(['cid' => $cid])
            ->all();
        $attributesByGid = MallSpecParam::loadAllAttributes(2);
        $attributesByOther = MallSpecParam::loadAllAttributes(3);
        $attrByCatalog = ArrayHelper::index($attributesByGid, null,'group_id');
        $rows = [];
        foreach ($models as $model) {
            $child = [];
            if (isset($attrByCatalog[$model->id])) {
                $row = $attrByCatalog[$model->id];
                foreach ($row as $item) {
                    $child[] = $item;
                }
            }

            $rows[$model->id] = [
                'name' => $model->name,
                'attributes' => $child
            ];
        }

        $rows['other'] = [
            'name' => '未分类',
            'attributes' => $attributesByOther
        ];

        return $rows;
    }
}
