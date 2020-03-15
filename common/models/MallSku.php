<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_sku}}".
 *
 * @property integer $id
 * @property integer $spu_id
 * @property string $sku_code
 * @property string $title
 * @property string $cost_price
 * @property string $price
 * @property string $special_price
 * @property integer $stock
 * @property string $weight
 * @property string $images
 * @property string $indexes
 * @property string $own_spec
 * @property integer $enable
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 */
class MallSku extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_sku}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spu_id', 'sku_code', 'title', 'price'], 'required'],
            [['spu_id', 'stock', 'enable', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['cost_price', 'price', 'special_price', 'weight'], 'number'],
            [['own_spec'], 'string'],
            [['sku_code'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 100],
            [['images'], 'string', 'max' => 500],
            [['indexes'], 'string', 'max' => 255],
            [['sku_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'spu_id' => 'Spu ID',
            'sku_code' => 'Sku Code',
            'title' => 'Title',
            'cost_price' => 'Cost Price',
            'price' => 'Price',
            'special_price' => 'Special Price',
            'stock' => 'Stock',
            'weight' => 'Weight',
            'images' => 'Images',
            'indexes' => 'Indexes',
            'own_spec' => 'Own Spec',
            'enable' => 'Enable',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ]);
    }
}
