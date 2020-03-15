<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_spec_param}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $group_id
 * @property string $name
 * @property integer $numeric
 * @property string $unit
 * @property integer $generic
 * @property integer $searching
 * @property string $segments
 */
class MallSpecParam extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_spec_param}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'group_id', 'numeric', 'generic', 'searching'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 16],
            [['segments'], 'string', 'max' => 500],
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
            'group_id' => 'Group ID',
            'name' => 'Name',
            'numeric' => 'Numeric',
            'unit' => 'Unit',
            'generic' => 'Generic',
            'searching' => 'Searching',
            'segments' => 'Segments',
        ]);
    }
}
