<?php

namespace common\models;

use Yii;
use yii\base\Exception;
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

    /**
     * @param $brandId
     * @param array $needAdds
     * @param array $needRemoves
     */
    public static function addDataByBrand($brandId, $needAdds = [], $needRemoves = [])
    {
        if ($needAdds) {
            foreach ($needAdds as $item) {
                $model = new self();
                $model->setAttributes([
                    'category_id' => $item,
                    'brand_id' => $brandId
                ]);
                if (!$model->save()) {
                    throw new Exception("save mall-brand error");
                }
            }
        }

        if ($needRemoves) {
            self::deleteAll(['category_id' => $needRemoves, 'brand_id' => $brandId]);
        }
    }

}
