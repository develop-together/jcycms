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
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)) {
            return false;
        }

        $uploaded = $this->uploadMultiple('photo_file_ids', '@original/' . date('Ymd') . '/');
        // var_dump($uploaded);exit;
        $this->photo_file_ids = implode(',', $uploaded);

        if($this->getOldAttribute('photo_file_ids')) {
            $this->photo_file_ids .= ',' . $this->getOldAttribute('photo_file_ids');
        }

        return true;
    }

}