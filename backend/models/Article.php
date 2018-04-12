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
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

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

        $upload = UploadedFile::getInstance($this, 'thumb');
        if ($upload !== null) {
            $uploadPath = yii::getAlias('@thumb/');
            if (! FileHelper::createDirectory($uploadPath)) { 
                $this->addError('thumb', "Create directory failed " . $uploadPath);
                return false;
            }

            $fullName = $uploadPath . uniqid() . '_' . $upload->baseName . '.' . $upload->extension;
            if(! $upload->saveAs($fullName)) {
                $this->addError('thumb', yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', 'Thumb')]) . ': ' . $fullName);
                return false;                
            }

            $this->thumb = str_replace(yii::getAlias('@backend/web'), '', $fullName);
            if ($this->flag_headline == null) {
                $this->flag_headline = 0;
            }

            if ($this->flag_recommend == null) {
                $this->flag_recommend = 0;
            }

            if ($this->flag_slide_show == null) {
                $this->flag_slide_show = 0;
            }

            if ($this->flag_special_recommend == null) {
                $this->flag_special_recommend = 0;
            }

            if ($this->flag_roll == null) {
                $this->flag_roll = 0;
            }

            if ($this->flag_bold == null) {
                $this->flag_bold = 0;
            }

            if ($this->flag_picture == null) {
                $this->flag_picture = 0;
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
/*    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $contentModel = new ArticleContent();
            $contentModel->aid = $this->id;
        } else {
            if ($this->content === null) {
                return;
            }
            $contentModel = ArticleContent::findOne(['aid' => $this->id]);
            if ($contentModel == null) {
                $contentModel = new ArticleContent();
                $contentModel->aid = $this->id;
            }
        }
        $contentModel->content = $this->content;
        $contentModel->save();
        parent::afterSave($insert, $changedAttributes);
    }*/

}