<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%admin_role_user}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $role_id
 * @property string $created_at
 * @property string $updated_at
 */
class AdminRoleUser extends \common\components\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_role_user}}';
    }

    public function behaviors()
    {
        if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
            $behaviors[] = TimestampBehavior::className();
        }

        return $behaviors;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Uid'),
            'role_id' => Yii::t('app', 'Role ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
