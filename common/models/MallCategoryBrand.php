<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_category_brand}}".
 *
 * @property integer $category_id
 * @property integer $brand_id
 */
class MallCategoryBrand extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_category_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id'], 'required'],
            [['category_id', 'brand_id'], 'integer'],
            [['category_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
        ]);
    }
}
