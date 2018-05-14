<?php

namespace common\components;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\modules\attachment\models\Attachment;

/**
 * base model
 */
class BaseModel extends \yii\db\ActiveRecord 
{
    const TARGET_BLANK = '_blank';
    const TARGET_SELF = '_self';
    const TAGET_PARENT = '_parent';
    const TAGET_TOP = '_top';
    
	public static function getDb()
	{
		return Yii::$app->get('db');
	}

	public function behaviors() {
		$behaviors = [];
		if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
			$behaviors[] = TimestampBehavior::className();
		}
        
		return $behaviors;
	}

	public function attributeLabels()
	{
		return [
			'created_at' => '创建时间',
			'updated_at' => '修改时间',
		];
	}

    public function image($attribute = '', $htmlOptions = [])
    {
        $src = $this->path($attribute);
        $alt = isset($htmlOptions['alt']) ? $htmlOptions['alt'] : '';
        return Html::image($src, $alt, $htmlOptions);
    }

    /**
     * 系统上传的图片、文件地址
     * @param  string $attribute 
     * @return string            
     */
    public function path($attribute = '')
    {
        return Utils::photoUrl($this->$attribute);
    }

	/**
     * 验证有错误时输出给前端回调函数
     * @return [type] [description]
     */
    public function afterValidate()
    {
    	if ($this->hasErrors()) {
    		$message = '<strong>以下表单填写有误:</strong><br>';
			foreach ($this->getErrors() as $value) {
				$message .= implode(",", $value) . '<br>';
			}

			Yii::$app->getSession()->setFlash('error', $message);  

    	}
    }

    /**
     * 保存数据前统一处理
     * @return boolean true为可保存， false不可保存
     */
    public function beforeSave($insert) 
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($this->isNewRecord && $this->hasAttribute('user_id')) {
            $this->user_id = Yii::$app->user->id;
        }

        return true;
    }

    public function getStatusFormat()
    {
        $statusOption = BaseConfig::statusOption();
        if ($this->hasAttribute('status')) {
            return $statusOption[$this->status];
        }
    }	

    public static function getDrowDownList($tree=[], &$result=[], $deep=0, $separator = "　　")
    {
        $deep++;
        foreach ($tree as $list) {

            $result[$list['id']] = $deep == 1 ? str_repeat($separator, $deep-1) . $list['name'] : str_repeat($separator, $deep-1) . '├' . $list['name'];
            if (isset($list['children'])) {
                self::getDrowDownList($list['children'], $result, $deep);
            }
        }

        return $result;
    }

    public function uploadMultiple($field='thumb', $uploadAlias='@thumb/', $attribute='Thumb')
    {
        $uploads = UploadedFile::getInstances($this, $field);
        $result = [];
        if ($uploads) {
            foreach ($uploads as $upload) {
                $result[] = $this->uploadOpreate($field, $uploadAlias, $attribute, $upload);
            }
        }

        return $result;
    }

    public function uploadOpreate($field='thumb', $uploadAlias='@thumb/', $attribute='Thumb', $UploadedFile= null)
    {
        $upload = $UploadedFile === null ? UploadedFile::getInstance($this, $field) : $UploadedFile;
        // var_dump($upload);exit;
        if ($upload !== null) {
            $uploadPath = yii::getAlias($uploadAlias);
            if (! FileHelper::createDirectory($uploadPath)) { 
                $this->addError($field, "Create directory failed " . $uploadPath);
                return false;
            }

            $baseName = $upload->baseName;
            $extension = $upload->extension;
            $uniqid = time() . '-' . uniqid();
            if (Utils::chinese($baseName)) {
                $baseName = iconv('UTF-8', 'GBK', $baseName);
            }

            $fullName = $uploadPath . $uniqid . '_' . $baseName . '.' . $extension;
            $filename = $uploadPath . $uniqid . '_' . $upload->baseName . '.' . $extension;
            if(! $upload->saveAs($fullName)) {
                $this->addError($field, yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', $attribute)]) . ': ' . $filename);

                return false;                
            }

            $attachmentModel = new Attachment();
            $relativePath = str_replace(yii::getAlias('@backend/web'), '', $filename);
            if (!$attachmentModel->saveAttachments($upload, $relativePath, $uploadPath)) {
                $this->addError($field, yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', $attribute)]) . ': ' . $filename);

                return false; 
            }

            return !$UploadedFile ? $relativePath : $attachmentModel->id;
        }
    
        return !$this->isNewRecord ? $this->getOldAttribute($field) : '';
    }

    public static function loadTragetOptions()
    {
        return [
            self::TARGET_BLANK => '新窗口中打开被链接文档(_blank)',
            self::TARGET_SELF => '相同的框架中打开被链接文档(_slef)',
            self::TAGET_PARENT => '父框架集中打开被链接文档(_parent)',
            self::TAGET_TOP => '整个窗口中打开被链接文档(_top)',
        ];
    }

}