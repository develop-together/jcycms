<?php

namespace backend\models;

use yii;
//use frontend\models\Comment;
use common\components\Utils;
use common\models\ArticleMeta;

class Article extends \common\models\Article
{

    public $width = 160;
    
    public $height = 220;

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->thumb = $this->uploadOpreate();

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $metaModel = new ArticleMeta();
        $metaModel->setArticleTags($this->id, $this->tag);

        parent::afterSave($insert, $changedAttributes);
    }
}