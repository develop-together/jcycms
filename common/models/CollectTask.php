<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\User;
use common\components\BaseConfig;

/**
 * This is the model class for table "{{%collect_task}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $status
 * @property string $url
 * @property string $rule
 * @property integer $created_at
 * @property integer $updated_at
 */
class CollectTask extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collect_task}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['name', 'url'], 'string', 'max' => 100],
            ['status', 'in', 'range' => [1, 2]],
            ['status', 'default', 'value' => 1],
            [['rule'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Created by'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'url' => Yii::t('app', 'Collect Url'),
            'rule' => Yii::t('app', 'Rule'),
        ]);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getStatusFormat()
    {
        return BaseConfig::getStatusItems($this->status);
    }
}
