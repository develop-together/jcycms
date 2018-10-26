<?php
/**
 * Author: lf
 * Blog: https://blog.feehi.com
 * Email: job@feehi.com
 * Created at: 2016-04-11 09:53
 */

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
        if(!parent::beforeSave($insert)) {
            return false;
        }

        $this->thumb = $this->uploadOpreate();

        return true;
    }
}