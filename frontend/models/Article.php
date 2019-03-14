<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 10:06:58
 */
namespace frontend\models;

use Yii;

class Article extends \common\models\Article
{
    public function getThumbUrl()
    {
        if (empty($this->thumb))
        	return $this->thumb = '/static/common/images/none.jpg';

        // return Yii::$app->params['backendUrl'] . '/' . $this->thumb;
       	return $this->thumb;
    }
}
