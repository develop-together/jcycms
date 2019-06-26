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
    // 针对所有需要使用feehiWeight上传组件的model，都需要加入一个删除旧文件id的属性
    // 如：上传文件的字段是photo_file_ids，则删除文件的字段是del_file_photo_file_ids
    // 当一个model里面有多个上传属性，那就对应有多个删除旧文件的属性
    // 如：thumb del_file_thumb|avatar del_file_avatar
    // 如果有scenarios的请在scenarios里面加入
    // 2019-06-24记-后期优化
    public $del_file_photo_file_ids = '';

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
                'del_file_photo_file_ids',
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
        if ($insert) {
            $this->type = parent::PHOTOS_PAGE;
            $this->photo_file_ids = implode(',', $uploaded);

        } else  {
            $new_file_ids = implode(',', $uploaded);
            $this->del_file_photo_file_ids = rtrim($this->del_file_photo_file_ids, ',');
            $del_file_photo_file_ids = explode(',', $this->del_file_photo_file_ids);
            $old_photo_file_ids = explode (',', rtrim( $this->getOldAttribute('photo_file_ids'), ',') );
            $diffa = array_diff($old_photo_file_ids, $del_file_photo_file_ids);
            if (!empty($diffa)) {
                $this->photo_file_ids = implode(',', $diffa) . ',' . $new_file_ids;
            } else {
                $this->photo_file_ids = $new_file_ids;
            }
        }


        return true;
    }

    public function afterFind()
    {
        \common\components\BaseModel::afterFind();
    }
}