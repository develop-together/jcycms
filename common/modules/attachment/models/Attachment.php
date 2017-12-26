<?php

namespace common\modules\attachment\models;

use Yii;

/**
 * This is the model class for table "{{%attachment}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $table_id
 * @property string $filename
 * @property string $filetype
 * @property string $extension
 * @property integer $filesize
 * @property string $filesizecn
 * @property string $filepath
 * @property string $ip
 * @property string $web
 * @property integer $downci
 * @property integer $created_at
 * @property integer $updated_at
 */
class Attachment extends \common\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'table_id', 'filesize', 'downci', 'created_at', 'updated_at'], 'integer'],
            [['filename', 'filepath', 'web'], 'string', 'max' => 255],
            [['filetype', 'extension'], 'string', 'max' => 45],
            [['filesizecn', 'ip'], 'string', 'max' => 30],
            [['user_id'], 'unique'],
            [['table_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Uid'),
            'table_id' => 'Table ID',
            'filename' => 'Filename',
            'filetype' => 'Filetype',
            'extension' => 'Extension',
            'filesize' => 'Filesize',
            'filesizecn' => 'Filesizecn',
            'filepath' => 'Filepath',
            'ip' => 'Ip',
            'web' => 'Web',
            'downci' => 'Downci',
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
