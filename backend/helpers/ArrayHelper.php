<?php
declare(strict_types=1);
/**
 * Created by PhpStorm
 * User: Administrator
 * Author: JieChengYang
 * Date: 2020-05-08
 * Time: 21:57
 */

namespace backend\helpers;


/**
 * Class ArrayHelper
 * @package backend\helpers
 */
class ArrayHelper extends \yii\helpers\ArrayHelper
{
    /**
     * 比较两个数组前后值并返回需要增加和删除的
     * eg:权限列表修改使用
     *
     * @param array $newData 新数据
     * @param array $oldData 旧数据
     * @param string $type add remove
     * @return array
     */
    public static function needAdd2Removes(array $newData, array $oldData, ?string $type = null): array
    {
        if ($type === null) {
            $needAdds = array_diff($newData, $oldData);
            $needRemoves = array_diff($oldData, $newData);
            return [
                'needAdds' => $needAdds,
                'needRemoves' => $needRemoves,
            ];
        } elseif ($type === 'add') {
            $needAdds = array_diff($newData, $oldData);
            return [
                'needAdds' => $needAdds,
            ];
        } else {
            $needRemoves = array_diff($oldData, $newData);
            return [
                'needRemoves' => $needRemoves,
            ];
        }

    }
}