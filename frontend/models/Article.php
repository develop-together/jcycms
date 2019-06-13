<?php
/**
 *
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 10:06:58
 */
namespace frontend\models;

use Yii;
use common\models\ArticleQuery;
use common\components\Utils;

class Article extends \common\models\Article
{
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    public function getThumbUrl()
    {
        if (empty($this->thumb))
        	return $this->thumb = '/static/common/images/none.jpg';

        // return Yii::$app->params['backendUrl'] . '/' . $this->thumb;
       	return $this->thumb;
    }

    // updateAllCounters
    public function updateScanCount()
    {
        // $key = 'article_scan_count_' . $this->id;
        // $cacheCount = Yii::$app->cache->get($key);
        // if ($cacheCount === null) {
        //     Yii::$app->cache->set($key, 1);//$this->scan_count +
        //     return true;
        // }

        // if ($cacheCount >= self::MAX_CACHE_COUNT) {
        //     $this->updateCounters(['scan_count' => $cacheCount]);
        //     Yii::$app->getCache()->delete($key);
        //     return true;
        // }

        // Yii::$app->cache->set($key, $cacheCount + 1);
        $this->updateCounters(['scan_count' => 1]);
        // $this->scan_count ? $this->scan_count + 1 : 1
        return true;
    }

    public function afterFind()
    {
        $this->created_at = Utils::tranDateTime($this->created_at);
        parent::afterFind();
    }
}
