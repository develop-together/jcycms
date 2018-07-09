<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%auth_item}}".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $rule_name
 * @property string $method
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class AuthItem extends \common\components\BaseModel
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'created_at', 'updated_at'], 'integer'],
            [['rule_name', 'method'], 'required'],
            [['description'], 'string'],
            [['rule_name', 'method'], 'string', 'max' => 64],
            [['rule_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'menu_id' => Yii::t('app', 'Related menus'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'method' => Yii::t('app', 'HTTP Method'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ]);
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }
}
