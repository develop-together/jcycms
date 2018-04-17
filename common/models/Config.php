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

    public static function loadData($refresh = false, $key='_config')
    {
        if ($refresh) {
            Yii::$app->cache->delete($key);
        }

        $data = Yii::$app->cache->get($key);
        if (empty($data)) {
            $lists = self::findAll();
            foreach ($lists as $key => $value) {
                $data[$value->variable] = $value->value;
            }

            Yii::$app->cache->set($data);
        }

        return $data;
    }

    /**
     * 修改配置信息
     * @param  string $scope 类型
     * @param  array  $json  回调函数要输出的内容
     * @return [type]        输出json供前端回调
     */
    public static function updateData($scope = 'base', $key = 'Config')
    {
        $post = Yii::$app->request->post();
        if (isset($post[$key])) {
            foreach ($post[$key] as $k => $v) {
                self::updateVariable($k, $v, $scope);
            }

            return true;
        }

        return false;
    }

    /**
     * 更新配置
     * @param  [type] $var   配置项
     * @param  string $value 配置项的值
     * @param  [type] $scope 类型
     * @return integer       number of rows affected by the execution.
     */
    public static function updateVariable($variable, $value='', $scope='base')
    {
        return Yii::$app->db->createCommand("REPLACE INTO {{config}}(`scope`, `variable`, `value`) VALUES('$scope', '$variable', '$value')")->execute();
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
