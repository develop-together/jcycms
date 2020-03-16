<?php
declare(strict_types=1);
/**
 * Created by PhpStorm
 * User: Administrator
 * Author: JieChengYang
 * Date: 2020/3/16
 * Time: 21:01
 */

namespace common\models\query;


use api\components\ActiveQuery;
use common\components\BaseConfig;

class CatalogQuery extends ActiveQuery
{
    public function product()
    {
        return $this->andOnCondition(['type' => BaseConfig::PRODUCT_CATALOG_ID]);
    }

    public function article()
    {
        return $this->andOnCondition(['type' => BaseConfig::ARTICLE_CATALOG_ID]);
    }
}