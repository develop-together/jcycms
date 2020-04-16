<?php

namespace common\models;

use common\components\BaseConfig;
use common\components\BaseController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "{{%mall_spec_param}}".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $group_id
 * @property string $name
 * @property integer $data_type
 * @property string $unit
 * @property integer $generic
 * @property integer $searching
 * @property string $segments
 */
class MallSpecParam extends \common\components\BaseModel
{

    /**
     *
     */
    const  GENERIC_TYPE = 1;

    /**
     *
     */
    const CACHE_KEY = 'mall:specParam';
    /**
     *
     */
    const CACHE_GROUP_KEY = 'mall:specParam:group';
    /**
     *
     */
    const CACHE_OTHER_KEY = 'mall:specParam:noGroup';

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
            [['cid', 'group_id', 'data_type', 'generic', 'searching'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['unit', 'display_type'], 'string', 'max' => 16],
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
            'cid' => Yii::t('mall', 'Category'),
            'group_id' => Yii::t('mall', 'Mall Spec Group'),
            'name' => Yii::t('mall', 'Params Name'),
            'data_type' => Yii::t('mall', 'Data Type'),
            'unit' => Yii::t('mall', 'Unit'),
            'generic' => Yii::t('mall', 'Generic'),
            'searching' => Yii::t('mall', 'Searching'),
            'segments' => Yii::t('mall', 'Segments'),
            'display_type' => Yii::t('app', 'Type'),
        ]);
    }

    /**
     * @param $params
     * @param null $fromName
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function submitData($params, $fromName = null)
    {
        $fromName === null && $fromName = $this->formName();
        $segmentsSortName = $segmentsSort = [];
        if (isset($params[$fromName]['items'])) {
            isset($params[$fromName]['items']['sort']) && $segmentsSort = $params[$fromName]['items']['sort'];
            isset($params[$fromName]['items']['name']) && $segmentsSortName = $params[$fromName]['items']['name'];
            foreach ($segmentsSortName as $key => $item) {
                $arr = [
                    'index' => $key,
                    'sort' => $segmentsSort[$key],
                    'name' => $item,
                ];
                $segments[] = $arr;
            }
        }
//        $segments = array_combine($segmentsSortName, $segmentsSort);
        if (!empty($segments)) $params[$fromName]['segments'] = Json::encode($segments);

        return $this->load($params) && $this->save();
    }

    /**
     * @param int $type 1,2,3
     * @param bool $refresh
     * @return array|MallBrand[]|MallSpecGroup[]|MallSpecParam[]|mixed|\yii\db\ActiveRecord[]
     */
    public static function loadAllAttributes($type = 1, $refresh = false)
    {
        $query = self::find()
            ->select(['id', 'cid', 'group_id', 'data_type', 'name', 'display_type', 'unit', 'generic', 'searching', 'segments'])
            ->where(1);
        $cacheKey = self::CACHE_KEY;
        switch ($type) {
            case 2:
                $cacheKey = self::CACHE_GROUP_KEY;
                $query->andWhere('group_id IS NOT NULL');
                break;
            case 3:
                $cacheKey = self::CACHE_OTHER_KEY;
                $query->andWhere(['group_id' => NULL]);
                break;
            default:
                break;
        }
        if ($refresh)
            Yii::$app->cache->delete($cacheKey);
        $data = Yii::$app->cache->get($cacheKey);
        if (empty($data)) {
            $data = $query->orderBy(['created_at' => SORT_DESC])
                ->asArray()
                ->all();
            Yii::$app->cache->set($cacheKey, $data);
        }

        return $data;
    }

    /**
     * @return bool
     */
    public function getIsSelectDis()
    {
        return $this->display_type === BaseConfig::FORM_SELECT;
    }

    /**
     * @return mixed
     */
    public function getDataTypeFormat()
    {
        return BaseConfig::getDataTypes($this->data_type);
    }

    /**
     * @return mixed
     */
    public function getGenericFormat()
    {
        return BaseConfig::getYesNoItems($this->generic);
    }

    /**
     * @return mixed
     */
    public function getSearchingFormat()
    {
        return BaseConfig::getYesNoItems($this->searching);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(MallSpecGroup::class, ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MallCategory::class, ['id' => 'cid']);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->group) $this->cid = $this->group->cid;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        Yii::$app->cache->delete(self::CACHE_KEY);
    }

    /**
     *
     */
    public function afterDelete()
    {
        parent::afterDelete(); // TODO: Change the autogenerated stub
        Yii::$app->cache->delete(self::CACHE_KEY);
    }

}
