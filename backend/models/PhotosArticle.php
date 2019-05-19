<?php
/**
 * Author: yjc
 * Blog: https://www.cnblogs.com/YangJieCheng/
 * Email: 2064320087@qq.com
 * Created at: ‎2018‎年‎5‎月‎8‎日
 */

namespace backend\models;

use yii;
use common\components\Utils;

class PhotosArticle extends \common\models\Article
{
    public function scenarios()
    {
        return [
            'default' => [
                'type',
                'category_id',
                'title',
                'sub_title',
                'summary',
                'seo_title',
                'seo_keywords',
                'seo_description',
                'status',
                'can_comment',
                'visibility',
                'tag',
                'sort',
                'photo_file_ids',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)) {
            return false;
        }

        $uploaded = $this->uploadMultiple('photo_file_ids', '@original/' . date('Ymd') . '/');
        $this->photo_file_ids = implode(',', $uploaded);
        if($this->getOldAttribute('photo_file_ids')) {
            $this->photo_file_ids .= ',' . $this->getOldAttribute('photo_file_ids');
        }

        return true;
    }

    public function afterFind()
    {
        \common\components\BaseModel::afterFind();
    }
}