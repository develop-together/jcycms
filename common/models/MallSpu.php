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
 * @property string $sub _title
 * @property integer $cid1
 * @property integer $cid2
 * @property integer $cid3
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $weight
 * @property string $dim
 * @property integer $saleable
 * @property integer $valid
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
            [['spu_code'], 'required'],
            [['cid1', 'cid2', 'cid3', 'brand_id', 'saleable', 'valid', 'sort', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['weight'], 'number'],
            [['spu_code'], 'string', 'max' => 16],
            [['title', 'sub _title', 'dim'], 'string', 'max' => 200],
            [['brand_name'], 'string', 'max' => 100],
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
            'spu_code' => 'Spu Code',
            'title' => 'Title',
            'sub _title' => 'Sub Title',
            'cid1' => 'Cid1',
            'cid2' => 'Cid2',
            'cid3' => 'Cid3',
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'weight' => 'Weight',
            'dim' => 'Dim',
            'saleable' => 'Saleable',
            'valid' => 'Valid',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ]);
    }
}
