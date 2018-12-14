<?php

namespace backend\models;

use yii;
//use frontend\models\Comment;
use common\components\Utils;

class Article extends \common\models\Article
{

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
}