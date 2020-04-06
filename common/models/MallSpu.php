<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_spu}}".
 *
 * @property integer $id
 * @property string $spu_code
 * @property string $title
 * @property string $sub_title
 * @property string $keyword
 * @property integer $cid1
 * @property integer $cid2
 * @property integer $cid3
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $weight
 * @property string $dim
 * @property integer $flag_saleable
 * @property integer $flag_new
 * @property integer $flag_hot
 * @property integer $flag_recommend
 * @property integer $flag_valid
 * @property integer $min_stock
 * @property string $image_ids
 * @property string $content
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class MallSpu extends \common\components\BaseModel
{

    public $mallAttributes = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_spu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spu_code', 'title', 'weight', 'cost_price', 'price', 'cid3', 'brand_id', 'keyword', 'image_ids', 'unit', 'stock', 'content'], 'required'],
            [['cost_price', 'price', 'cid1', 'cid2', 'cid3', 'brand_id', 'flag_saleable', 'flag_new', 'flag_hot', 'flag_recommend', 'flag_valid', 'min_stock', 'sort', 'created_at', 'updated_at', 'deleted_at', 'stock', 'min_stock'], 'integer'],
            [['weight'], 'number'],
            [['content'], 'string'],
            [['spu_code'], 'string', 'max' => 16],
            [['title', 'sub_title', 'keyword', 'dim'], 'string', 'max' => 200],
            [['brand_name', 'image_ids'], 'string', 'max' => 100],
            [['spu_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('mall', 'ID'),
            'spu_code' => Yii::t('mall', 'Spu Code'),
            'title' => Yii::t('mall', 'Title'),
            'sub_title' => Yii::t('mall', 'Sub Title'),
            'keyword' => Yii::t('mall', 'Keyword'),
            'cid1' => Yii::t('mall', 'Category'),
            'cid2' => Yii::t('mall', 'Category'),
            'cid3' => Yii::t('mall', 'Category'),
            'brand_id' => Yii::t('mall', 'Brand Name'),
            'brand_name' => Yii::t('mall', 'Brand Name'),
            'weight' => Yii::t('mall', 'Weight'),
            'dim' => Yii::t('mall', 'Place'),
            'flag_saleable' => Yii::t('mall', 'Flag Saleable'),
            'flag_new' => Yii::t('mall', 'Flag New'),
            'flag_hot' => Yii::t('mall', 'Flag Hot'),
            'flag_recommend' => Yii::t('mall', 'Flag Recommend'),
            'flag_valid' => Yii::t('mall', 'Flag Valid'),
            'min_stock' => Yii::t('mall', 'Min Stock'),
            'image_ids' => Yii::t('mall', 'Images'),
            'content' => Yii::t('mall', 'Content'),
            'cost_price' => Yii::t('mall', 'Cost Price'),
            'price' => Yii::t('mall', 'Price'),
            'unit' => Yii::t('mall', 'Unit'),
            'stock' => Yii::t('mall', 'Stock'),
            'mallAttributes' => Yii::t('mall', 'Attribute'),
        ]);
    }

    public function generateSpuCode()
    {
        return time();
    }
}
