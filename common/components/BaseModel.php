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

	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    self::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ]
        ];
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

        return Html::img($src, $htmlOptions);
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

    public function getErrorFormat()
    {
        $errors = [];
        foreach ($this->errors as $err) {
            $errors[] = $err[0];
        }

        return $errors;
    }

	/**
     * 验证有错误时输出给前端回调函数
     * @return [type] [description]
     */
    public function afterValidate()
    {
    	if ($this->hasErrors()) {
    		$message = '<strong>' . Yii::t('common', 'The following form is mistaken') . ':</strong><br>';
            if(Yii::$app->request->isAjax) {
                exit(Json::encode(['code' => 10001, 'message' => implode('<br>', $this->getErrorFormat())]));
            }

            $errors = '';
			foreach ($this->getErrors() as $value) {
				$errors .= implode(",", $value) . '<br>';
			}

            if (Yii::$app->id != 'app-console') {
                Yii::$app->getSession()->setFlash('error', $message . $errors);
            } else {
                exit(str_replace('<br>', '|', $errors));
            }


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

        if (Yii::$app->id == 'app-backend'
            && $this->isNewRecord
            && $this->hasAttribute('user_id')
            && empty($this->user_id)
            && $this->formName() != 'AdminRoleUser'
        ) {
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

    public function getAvatarFormat()
    {
        if ($this->hasAttribute('avatar') && $this->avatar) {
            if(strpos($this->avatar, Yii::$app->params['uploadSaveFilePath']) !== false) {
                return Yii::$app->request->baseUrl  . '/' . $this->avatar;
            }

            return Yii::$app->request->baseUrl . '/' . Yii::$app->params['uploadSaveFilePath'] . '/' . $this->avatar;
        }

        return Yii::$app->request->baseUrl . '/static/img/noface.png';
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

    public function uploadMultiple($field='thumb', $uploadAlias='@original/', $attribute='Thumb')
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

    public function uploadOpreate($field='thumb', $uploadAlias='@original/', $attribute='Thumb', $UploadedFile= null)
    {
        if (Yii::$app->id == 'app-api') {
            $upload = UploadedFile::getInstanceByName($field);
        } else {
            $upload = $UploadedFile === null ? UploadedFile::getInstance($this, $field) : $UploadedFile;
        }

        if ($upload !== null) {
            $uploadPath = yii::getAlias($uploadAlias);
            if (! FileHelper::createDirectory($uploadPath)) {
                $this->addError($field, "Create directory failed " . $uploadPath);
                return false;
            }

            $baseName = $upload->baseName;
            $extension = $upload->extension;
            $uniqid = time() . '-' . uniqid();
            // if (Utils::chinese($baseName)) {
            //     $baseName = iconv('UTF-8', 'GBK', $baseName);
            //     $baseName = mb_convert_encoding($basename, 'UTF-8', 'GBK');
            // }

            $fullName = $uploadPath . $uniqid . '_' . $baseName . '.' . $extension;
            $filename = $uploadPath . $uniqid . '_' . $upload->baseName . '.' . $extension;
            if(! $upload->saveAs($fullName)) {
                $this->addError($field, Yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => Yii::t('app', $attribute)]) . ': ' . $filename);

                return false;
            }

            $attachmentModel = new Attachment();
            // $relativePath = str_replace(Yii::getAlias('@backend/web/'), '', $filename);
            $relativePath = Utils::getRelativePath($filename);
            if (!$attachmentModel->saveAttachments($upload, $relativePath, $uploadPath)) {
                $this->addError($field, Yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => Yii::t('app', $attribute)]) . ': ' . $filename);

                return false;
            }

            // 给需要裁剪的地方加入裁剪(两种情况：1、系统开启图片裁剪并设置裁剪尺寸2、对于广告设置了宽高)
            // 重点：删除原图
            if ($this->formName() === 'Ad') {
                if (!empty($this->width) && !empty($this->height)) {
                    $this->thumbUrl = ImageHelper::thumbnail($fullName, $this->width, $this->height);
                }
            }

            $clipping_img = \common\models\Config::getClippingImg();
            if (self::tableName() === "{{%article}}" && $this->hasAttribute('thumb') && $clipping_img === 1) {
                $relativePath = ImageHelper::thumbnail($fullName, $this->width, $this->height);
                file_exists($fullName) && @unlink($fullName);
            }

            if (! $this->isNewRecord) {
                if ($this->getOldAttribute($field) != $relativePath) {
                    $oldFile = str_replace("\\", '/', str_replace('uploads', '', Yii::getAlias('@uploads')) . $this->getOldAttribute($field));;
                    file_exists($oldFile) && @unlink($oldFile);
                }
            }

            if (Yii::$app->id == 'app-api' || !$UploadedFile) {
                return $relativePath;
            }

            return $attachmentModel->id;
        }

        return !$this->isNewRecord ? $this->getOldAttribute($field) : '';
    }

    public static function loadTragetOptions()
    {
        return [
            self::TARGET_BLANK => '新窗口中打开被链接文档(_blank)',
            self::TARGET_SELF => '相同的框架中打开被链接文档(_self)',
            self::TAGET_PARENT => '父框架集中打开被链接文档(_parent)',
            self::TAGET_TOP => '整个窗口中打开被链接文档(_top)',
        ];
    }

}
