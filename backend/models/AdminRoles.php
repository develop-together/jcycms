<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "{{%admin_roles}}".
 *
 * @property string $id
 * @property integer $parent_id
 * @property string $role_name
 * @property string $remark
 * @property string $created_at
 * @property integer $updated_at
 */
class AdminRoles extends \common\components\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_roles}}';
    }

    public function behaviors()
    {
        $behaviors = [];
        if ($this->hasAttribute('created_at') || $this->hasAttribute('updated_at')) {
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
            [['role_name'], 'required'],
            [['id', 'parent_id', 'created_at', 'updated_at'], 'integer'],
            [['role_name', 'remark'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'role_name' => Yii::t('app', 'Role'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    public function beforeDelete()
    {
        if ($this->id == 1) {
            throw new BadRequestHttpException(yii::t('app', 'Not allowed to delete {attribute}', ['attribute' => yii::t('app', 'super administrator roles')]));
        }

        return true;
    }

    public static function loadRolesOptions()
    {
        $roleModels = self::find()->all();
        $roles = [];
        if ($roleModels) {
            foreach ($roleModels as $roleModel) {
                $roles[$roleModel->id] = $roleModel->role_name;
            }
        }

        return $roles;
    }
}
