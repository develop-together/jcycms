<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%admin_role_permission}}".
 *
 * @property string $id
 * @property string $role_id
 * @property integer $opt_id
 * @property string $menu_id
 * @property string $created_at
 * @property string $updated_at
 */
class AdminRolePermission extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_role_permission}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'required'],
            [['role_id', 'opt_id', 'menu_id', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'role_id' => Yii::t('app', 'Role Id'),
            'menu_id' => Yii::t('app', 'Menu Id'),
            'opt_id' => Yii::t('app', 'Use ID'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'method' => Yii::t('app', 'Method'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::ClassName(), ['id' => 'menu_id']);
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->isNewRecord && $this->opt_id = Yii::$app->user->id;

        return true;
    }
}
