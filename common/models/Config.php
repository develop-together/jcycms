<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $scope
 * @property string $variable
 * @property string $value
 * @property string $description
 */
class Config extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variable'], 'required'],
            [['value'], 'string'],
            [['scope'], 'string', 'max' => 20],
            [['variable'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
            [['variable'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'scope' => Yii::t('app', 'Scope'),
            'variable' => Yii::t('app', 'Variable'),
            'value' => Yii::t('app', 'Value'),
            'description' => Yii::t('app', 'Description'),
        ]);
    }
}
