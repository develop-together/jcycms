<?php

namespace backend\components;

use Yii;
use backend\models\AdminLog as AdminLogModel;

class AdminLog extends \yii\base\BaseObject
{
    /**
     * 数据库新增保存日志
     *
     * @param $event
     */
    public static function create($event)
    {
        if ($event->sender->className() !== AdminLogModel::className()) {
            $desc = '<br>';
            $class = $event->sender->className();
            foreach ($event->sender->getAttributes() as $name => $value) {
                if ($class::tableName() === '{{%article_content}}' && $name === 'content') {
                    $desc .= $event->sender->getAttributeLabel($name) . '(' . $name . ') => 私密';
                } else {
                    $desc .= $event->sender->getAttributeLabel($name) . '(' . $name . ') => ' . $value . ',<br>';
                }
            }
            $desc = substr($desc, 0, -5);
            $model = new AdminLogModel();
            $id_des = '';
            if (isset($event->sender->id)) {
                $id_des = '{{%ID%}} ' . $event->sender->id;
            }

            $model->description = '{{%ADMIN_USER%}} [ ' . Yii::$app->user->identity->username . ' ] {{%BY%}} ' . $class . ' [ ' . $class::tableName() . ' ] ' . " {{%CREATED%}} {$id_des} {{%RECORD%}}: " . $desc;
            $model->route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
            $model->user_id = Yii::$app->user->id;
            $model->save();
        }
    }

    /**
     * 数据库修改保存日志
     *
     * @param $event
     */
    public static function update($event)
    {
        if (!empty($event->changedAttributes)) {
            $desc = '<br>';
            $oldAttributes = $event->sender->oldAttributes;
            foreach ($event->changedAttributes as $name => $value) {
                if ($oldAttributes[$name] == $value) continue;
                $class = $event->sender->className();
                if ($class::tableName() === '{{%article_content}}' && $name === 'content') continue;
                $desc .= $event->sender->getAttributeLabel($name) . '(' . $name . ') : ' . $value . '=>' . $event->sender->oldAttributes[$name] . ',<br>';
            }
            $desc = substr($desc, 0, -5);
            $model = new AdminLogModel();
            $id_des = '';
            if (isset($event->sender->id)) {
                $id_des = '{{%ID%}} ' . $event->sender->id;
            }
            $model->description = '{{%ADMIN_USER%}} [ ' . Yii::$app->user->identity->username . ' ] {{%BY%}} ' . $class . ' [ ' . $class::tableName() . ' ] ' . " {{%UPDATED%}} {$id_des} {{%RECORD%}}: " . $desc;
            $model->route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
            $model->user_id = Yii::$app->getUser()->id;
            $model->save();
        }
    }

    /**
     * 数据库删除保存日志
     *
     * @param $event
     */
    public static function delete($event)
    {
        if ($event->sender->className() !== AdminLogModel::className()) {
            $desc = '<br>';
            foreach ($event->sender->getAttributes() as $name => $value) {
                $desc .= $event->sender->getAttributeLabel($name) . '(' . $name . ') => ' . $value . ',<br>';
            }
            $desc = substr($desc, 0, -5);
            $model = new AdminLogModel();
            $class = $event->sender->className();
            $id_des = '';
            if (isset($event->sender->id)) {
                $id_des = '{{%ID%}} ' . $event->sender->id;
            }
            $model->description = '{{%ADMIN_USER%}} [ ' . Yii::$app->user->identity->username . ' ] {{%BY%}} ' . $class . ' [ ' . $class::tableName() . ' ] ' . " {{%DELETED%}} {$id_des} {{%RECORD%}}: " . $desc;
            $model->route = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
            $model->user_id = Yii::$app->getUser()->id;
            $model->save();
        }

    }
}
