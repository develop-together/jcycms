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

    public $has_menu_id = 1;
    
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
            [['menu_id', 'created_at', 'updated_at', 'sort', 'auth_id'], 'integer'],
            [['rule_name', 'method'], 'required'],
            [['description'], 'string'],
            [['rule_name', 'method'], 'string', 'max' => 64],
            [['rule_format'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'auth_id' => Yii::t('app', 'Permission'),
            'menu_id' => Yii::t('app', 'Related menus'),
            'rule_name' => Yii::t('app', 'Rule Name'),
            'rule_format' => Yii::t('app', 'Rule Name'),
            'method' => Yii::t('app', 'HTTP Method'),
            'sort' => Yii::t('app', 'Sort'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'has_menu_id' => Yii::t('app', 'Association Menu'),
        ]);
    }

    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id' => 'menu_id']);
    }

    public function getMenuFormat()
    {
        return $this->menu ? $this->menu->name : Yii::t('app', 'Other');
    }

    public static function loadOtherAuth()
    {
        return self::find()->where(['menu_id' => null])->orderBy(['created_at' => SORT_DESC])->all();
    }
}
