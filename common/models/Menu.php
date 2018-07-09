<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\AuthItem;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $type
 * @property string $parent_id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property string $byt_menucol
 * @property string $sort
 * @property string $target
 * @property integer $is_absolute_url
 * @property integer $is_display
 * @property integer $method
 * @property string $created_at
 * @property string $updated_at
 */
class Menu extends \common\components\BaseModel
{
    const MENU_TYPE_FRONTEND = 1;
    const MENU_TYPE_BACKEND = 0;
    const ABSOLUTE_URL = 1;
    const NOT_ABSOLUTE_URL = 0;
    const DISPLAY_SHOW = 1;
    const NOT_DISPLAY_SHOW = 0;
    const REQUEST_METHOD_ON_ALL = 0;
    const REQUEST_METHOD_ON_GET = 1;
    const REQUEST_METHOD_ON_POST = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'parent_id', 'sort', 'is_absolute_url', 'is_display', 'method', 'created_at', 'updated_at', 'isAddRoute'], 'integer'],
            [['name', 'url'], 'required'],
            [['name', 'url', 'icon'], 'string', 'max' => 255],
            [['target'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'parent_id' => Yii::t('app', 'Parent Id'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'method' => Yii::t('app', 'HTTP Method'),
            'icon' => Yii::t('app', 'Icon'),
            'sort' => Yii::t('app', 'Sort'),
            'is_absolute_url' => Yii::t('app', 'Is Absolute Url'),
            'target' => Yii::t('app', 'Target'),
            'is_display' => Yii::t('app', 'Is Display'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'subMenus_format' => Yii::t('app', 'Related menus'),
            'isAddRoute' => Yii::t('app', 'Add to permissions'),
        ]);
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::ClassName(), ['parent_id' => 'id']);
    }

    public static function loadOptions()
    {
        $models = self::find()->where(['type' => self::MENU_TYPE_BACKEND])->all();
        $data = [];
        foreach ($models as $model) {
            $data[$model->id] = $model->name;
        }

        return $data;
    }

    public static function loadDisplayOptions()
    {
        return [
            self::DISPLAY_SHOW => Yii::t('app', 'Yes'),
            self::NOT_DISPLAY_SHOW => Yii::t('app', 'No'),
        ];
    }

    public static function loadMethodOptions()
    {
        return [
            self::REQUEST_METHOD_ON_ALL => 'all',
            self::REQUEST_METHOD_ON_GET => 'get',
            self::REQUEST_METHOD_ON_POST => 'post',
        ];
    }

    public static function loadAbsoluteOptions()
    {
        return [
            self::ABSOLUTE_URL => Yii::t('app', 'Yes'),
            self::NOT_ABSOLUTE_URL => Yii::t('app', 'No'),
        ];
    }

    public function getDisplayFormat()
    {
        $data = self::loadDisplayOptions();

        return isset($data[$this->is_display]) ? $data[$this->is_display] : '';
    }

    public function getAbsoluteUrlFormat()
    {
        $data = self::loadAbsoluteOptions();

        return isset($data[$this->is_absolute_url]) ? $data[$this->is_absolute_url] : '';
    }

    public function getMethodFormat()
    {
        $data = self::loadMethodOptions();

        return isset($data[$this->method]) ? $data[$this->method] : '';
    }

    public function getNameFormat()
    {
        return $this->parent_id ? '　├' . $this->name : $this->name;
    }

    public function getIconFormat()
    {
        return "<i class=\"fa {$this->icon}\"></i>";
    }

    public function getUrlFormat()
    {
        if (empty($this->url)) {
            return '';
        }

        if ($this->isCorrect) {
            return $this->url;
        }

        return Url::toRoute([$this->url]);
    }

    public function getIsCorrect()
    {
        return in_array(strtolower($this->url), ['/', '#', 'javascript:;']);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $parentScenarios = parent::scenarios();

        return array_merge($parentScenarios, [
            'backend' => ['parent_id', 'name', 'url', 'icon', 'type', 'is_absolute_url', 'target', 'sort', 'is_display', 'method'],
            'frontend' => ['parent_id', 'name', 'url', 'type', 'is_absolute_url', 'target', 'sort', 'is_display'],
        ]);
    }

    public function beforeSave($insert) 
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        
        if ($this->sort == null) {
            $this->sort = 0;
        }

        if ($this->parent_id == null) {
            $this->parent_id = 0;
        }

        if ($this->isNewRecord) {
            $this->getScenario() == 'frontend' && $this->type = self::MENU_TYPE_FRONTEND;
        }

        return true;
    }

    public function beforeDelete()
    {
        if ($this->children) {
            $this->addError('id', Yii::t('app', 'Sub Menu exists, cannot be deleted'));
            return false;
        }

        if($this->name === '首页') {
            $this->addError('id', Yii::t('app', 'Can not delete the home page'));
            return false;            
        }

        return true;
    }
}
