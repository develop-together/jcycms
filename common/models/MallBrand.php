<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_brand}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $brand_code
 * @property string $image
 * @property string $letter
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 */
class MallBrand extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'brand_code'], 'required'],
            [['sort', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['brand_code'], 'string', 'max' => 16],
            [['image'], 'string', 'max' => 255],
            [['letter'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'name' => 'Name',
            'brand_code' => 'Brand Code',
            'image' => 'Image',
            'letter' => 'Letter',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ]);
    }
}
