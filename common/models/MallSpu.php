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
 * @property integer $cid1
 * @property integer $cid2
 * @property integer $cid3
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $weight
 * @property string $dim
 * @property integer $saleable
 * @property integer $valid
 * @property string $image_ids
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class MallSpu extends \common\components\BaseModel
{

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
            [['spu_code', 'title', 'keyword'], 'required'],
            [['cid1', 'cid2', 'cid3', 'brand_id', 'saleable', 'valid', 'sort', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['weight'], 'number'],
            [['spu_code'], 'string', 'max' => 16],
            [['title', 'sub_title', 'dim'], 'string', 'max' => 200],
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
            'id' => 'ID',
            'spu_code' => Yii::t('mall', 'Spu Code'),
            'title' => Yii::t('mall', 'Goods Title'),
            'sub_title' => Yii::t('mall', 'Sub Goods Title'),
            'cid1' => Yii::t('mall', 'Category'),
            'cid2' => Yii::t('mall', 'Category'),
            'cid3' => Yii::t('mall', 'Category'),
            'brand_id' => Yii::t('mall', 'Mall Brand'),
            'brand_name' => Yii::t('mall', 'Mall Brand'),
            'weight' => Yii::t('mall', 'Weight'),
            'dim' => Yii::t('mall', 'Base Addr'),
            'saleable' => Yii::t('mall', 'Saleable'),
            'valid' => Yii::t('mall', 'Valid'),
            'image_ids' => Yii::t('mall', 'Goods Image'),
            'keyword' => Yii::t('app', 'Keyword'),
            'sort' => Yii::t('app', 'Sort'),
        ]);
    }
}
