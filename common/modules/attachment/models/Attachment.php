<?php

namespace common\modules\attachment\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use backend\models\User;

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
class Attachment extends \common\components\BaseModel
{
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
            [['filehash'], 'string', 'max' => 32]
        ];
    }

    /**
    * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'user_id' => Yii::t('common', 'Uid'),
            'table_id' => Yii::t('common', 'Table ID'),
            'filename' => Yii::t('common', 'Filename'),
            'filetype' => Yii::t('common', 'Filetype'),
            'extension' => Yii::t('common', 'Extension'),
            'filesize' => Yii::t('common', 'Filesize'),
            'filesizecn' => Yii::t('common', 'Filesize'),
            'filepath' => Yii::t('common', 'Filepath'),
            'fileinfo' => Yii::t('common', 'Fileinfo'),
            'filehash' => Yii::t('common', 'FileHash'),
            'ip' => 'Ip',
            'web' => 'Web',
            'downci' => Yii::t('common', 'Downci'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    /**
    * 上传错误检查
    * @param $errCode
    * @return string
    */
    private function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
    * 文件类型检测
    * @return bool
    */
    private function checkType($fileExt, $allowFiles)
    {
        return in_array($fileExt, $allowFiles);
    }

    public function saveData($params)
    {
        $this->user_id = Yii::$app->id == 'app-backend' ? Yii::$app->user->id : User::SUPER_MANAGER;
        $this->filename = $params['filename'];
        $this->filetype = $params['filetype'];
        $this->extension = $params['extension'];
        $this->filesize = $params['filesize'];
        $this->filesizecn = $params['filesizecn'];
        $this->filepath = $params['filepath'];
        $this->filehash = $params['filehash'];
        $this->ip = Yii::$app->request->userIP;
        $this->web = $this->getbrowser();
        if (!$this->save()) {
            @unlink($this->uploadPath . '/' . $this->filepath);
            return false;
        }

        return $this->id;
    }

    private function getbrowser()
    {
        $web    = Yii::$app->request->userAgent;
        $val    = 'IE';
        $parr = [
            ['MSIE 5'], ['MSIE 6'], ['XIAOMI', 'xiaomi'], ['HUAWEI', 'huawei'], ['DingTalk', 'ding'],
            ['MSIE 7'], ['MSIE 8'], ['MSIE 9'], ['MSIE 10'], ['MSIE 11'], ['rv:11', 'MSIE 11'], ['MSIE 12'],
            ['MSIE 13'], ['Firefox'], ['OPR/', 'Opera'], ['Chrome'], ['Safari'], ['Android'], ['iPhone']
        ];
        foreach ($parr as $wp) {
            if(strpos($web, $wp[0]) !== false) {
                $val    = $wp[0];
                if(isset($wp[1]))$val   = $wp[1];
                break;
            }
        }

        $web = strtolower($web);
        if (strpos($web,'micromessenger') !== false) {
            $val='wxbro';//微信浏览器
        }

        if (strpos($web,'dingtalk') !== false) {
            $val='ding';//钉钉浏览器
        }

        return $val;
    }

    public function getPictureJson()
    {
        return [
            'title' => $this->filename,
            'pid' => $this->id,
            'src' => $this->filepath,
            'thumb' => $this->filepath,
        ];
    }

    public function getFileFormat()
    {
        if (preg_match('/^images\/*$/', $this->filetype) !== false) {
            $src = Yii::$app->request->baseUrl . '/' . $this->filepath;
            $absoluteSrc = str_replace('uploads', '', Yii::getAlias('@uploads')) . $this->filepath;
            if (!file_exists($absoluteSrc)) {
                return Yii::t('common', 'The File Is Not Exists');
            }

            return Html::img($src, ['style' => 'width:70px;', 'alt' => $this->filename]);
        }

        return $this->filename;
    }

    public function getFileInfoFormat()
    {
        $info = explode('/', $this->filepath);
        $newName = end($info);
        $saveDir = $info[0] . '/' . $info[1];
        if (empty($this->filepath)) {
            return '';
        }

        return Html::tag('p', Yii::t('common', 'Old Name') . '：' . $this->filename) . Html::tag('p', Yii::t('common', 'Save Path') . '：' . $saveDir) . Html::tag('p', Yii::t('common', 'New Name') . '：' . $newName);
    }
}
