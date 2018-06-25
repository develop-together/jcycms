<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%options}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $name
 * @property string $value
 * @property integer $status
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 */
class Options extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%options}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'created_at'], 'required'],
            [['value'], 'string'],
            [['sort', 'created_at', 'updated_at'], 'integer'],
            [['type'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'value' => 'Value',
            'status' => 'Status',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ]);
    }
}
