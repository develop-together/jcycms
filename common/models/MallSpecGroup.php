<?php

namespace common\models;

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
            [['name', 'created_at'], 'required'],
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
            'cid' => 'Cid',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ]);
    }
}
