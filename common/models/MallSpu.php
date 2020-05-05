<?php

namespace common\models;

use common\components\Utils;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%mall_spu}}".
 *
 * @property integer $id
 * @property string $spu_code
 * @property string $title
 * @property string $sub_title
 * @property string $keyword
 * @property integer $cid1
 * @property integer $cid2
 * @property integer $cid3
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $weight
 * @property string $dim
 * @property integer $flag_saleable
 * @property integer $flag_new
 * @property integer $flag_hot
 * @property integer $flag_recommend
 * @property integer $flag_valid
 * @property integer $min_stock
 * @property string $images
 * @property string $content
 * @property integer $sort
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 */
class MallSpu extends \common\components\BaseModel
{

    /**
     * @var null
     */
    public $mallAttributes = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mall_spu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['spu_code', 'title', 'weight', 'cost_price', 'price', 'cid3', 'brand_id', 'keyword', 'images', 'unit', 'stock', 'content'], 'required'],
            [['cost_price', 'price', 'cid1', 'cid2', 'cid3', 'brand_id', 'flag_saleable', 'flag_new', 'flag_hot', 'flag_recommend', 'flag_valid', 'min_stock', 'sort', 'created_at', 'updated_at', 'deleted_at', 'stock', 'min_stock'], 'integer'],
            [['weight'], 'number'],
            [['content'], 'string'],
            [['spu_code'], 'string', 'max' => 16],
            [['title', 'sub_title', 'keyword', 'dim'], 'string', 'max' => 200],
            [['brand_name'], 'string', 'max' => 100],
            [['images'], 'string', 'max' => 100],
            [['spu_code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => Yii::t('mall', 'ID'),
            'spu_code' => Yii::t('mall', 'Spu Code'),
            'title' => Yii::t('mall', 'Title'),
            'sub_title' => Yii::t('mall', 'Sub Title'),
            'keyword' => Yii::t('mall', 'Keyword'),
            'cid1' => Yii::t('mall', 'Category'),
            'cid2' => Yii::t('mall', 'Category'),
            'cid3' => Yii::t('mall', 'Category'),
            'brand_id' => Yii::t('mall', 'Brand Name'),
            'brand_name' => Yii::t('mall', 'Brand Name'),
            'weight' => Yii::t('mall', 'Weight'),
            'dim' => Yii::t('mall', 'Place'),
            'flag_saleable' => Yii::t('mall', 'Flag Saleable'),
            'flag_new' => Yii::t('mall', 'Flag New'),
            'flag_hot' => Yii::t('mall', 'Flag Hot'),
            'flag_recommend' => Yii::t('mall', 'Flag Recommend'),
            'flag_valid' => Yii::t('mall', 'Flag Valid'),
            'min_stock' => Yii::t('mall', 'Min Stock'),
            'images' => Yii::t('mall', 'Images'),
            'content' => Yii::t('mall', 'Content'),
            'cost_price' => Yii::t('mall', 'Cost Price'),
            'price' => Yii::t('mall', 'Price'),
            'unit' => Yii::t('mall', 'Unit'),
            'stock' => Yii::t('mall', 'Stock'),
            'mallAttributes' => Yii::t('mall', 'Attribute'),
        ]);
    }

    /**
     * @return int
     */
    public function generateSpuCode()
    {
        return time();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog3()
    {
        return $this->hasOne(MallCategory::class, ['id' => 'cid3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog2()
    {
        return $this->hasOne(MallCategory::class, ['id' => 'cid2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog1()
    {
        return $this->hasOne(MallCategory::class, ['id' => 'cid1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(MallBrand::class, ['id' => 'brand_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallSku()
    {
        return $this->hasMany(MallSku::class, ['spu_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return string
     */
    public function getSelectedAttrStr()
    {
        $selectedAttrStr = '';
        foreach ($this->mallSku as $mallSku) {
            /* @var MallSku $mallSku */
            $selectedAttrStr .= $mallSku->indexes . ',';
        }

        return rtrim($selectedAttrStr, ',');
    }

    /**
     * @return array
     */
    public function getSpecParams()
    {
        $params = [];
        $selectAttr = [];
        $attributes = [];
        foreach ($this->mallSku as $mallSku) {
            /* @var MallSku $mallSku */
            $ownSpec = unserialize($mallSku->own_spec);
            foreach ($ownSpec as $item) {
                $key = $item['gid'] . '_' . $item['attrId'];
                $params[$key] = $item;
                $selectAttr[] = $item['gid'] . '#' . $item['attrGroupName'];
            }
            $indexes = explode(',', $mallSku->indexes);
            $row = $mallSku->attributes;
            $row['fullname'] = $row['images'];
            $row['images'] = Utils::photoUrl($row['images']);
            if ($mallSku->attachment !== null) {
                $row['attachmentId'] = $mallSku->attachment->id;
                $row['filetype'] = $mallSku->attachment->filetype;
            } else {
                $row['attachmentId'] = 0;
                $row['filetype'] = 'image/jpeg';
            }

            foreach ($indexes as $index) {
                if (isset($params[$index])) {
                    $row[$params[$index]['field']] = $params[$index]['attrName'];
                    $row['item'] = $params[$index];
                }
            }
            unset($row['created_at'], $row['updated_at'], $row['own_spec']);
            $attributes[] = $row;
        }
        ArrayHelper::multisort($params, ['gid', 'attrId']);
        return [
            'selectAttr' => implode(',', array_unique($selectAttr)),
            'params' => $params,
            'attributes' => $attributes,
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->catalog3 && $this->catalog3->path) {
            $pathArr = explode(',', $this->catalog3->path);
            $pathArr = array_reverse($pathArr);
            $len = count($pathArr);
            while ($len++ == 3) array_push($pathArr, 0);
            list($cid1, $cid2, $cid3) = $pathArr;
            $this->cid1 = $cid1;
            $this->cid2 = $cid2;
            $this->cid3 = $cid3;
        }

        $this->images && $this->images = rtrim($this->images, '、');
        /* @var MallBrand $this ->brand */
        $this->brand !== null && $this->brand_name = $this->brand->name;
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     *
     */
    public function afterDelete()
    {
        MallSku::deleteAll(['spu_id' => $this->id]);
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }

    public function afterFind()
    {
        if ($this->images) {
            $images = explode('、', $this->images);
            $tmp = [];
            foreach ($images as $image) {
                $tmp[] = $image;
            }
            $this->images = $tmp;
        }
        parent::afterFind(); // TODO: Change the autogenerated stub
    }

}
