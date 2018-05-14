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
use common\components\Utils;

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

/*        $upload = UploadedFile::getInstance($this, 'thumb');
        if ($upload !== null) {
            $uploadPath = yii::getAlias('@thumb/');
            if (! FileHelper::createDirectory($uploadPath)) { 
                $this->addError('thumb', "Create directory failed " . $uploadPath);
                return false;
            }

            $baseName = $upload->baseName;
            if (Utils::chinese($baseName)) {
                $baseName = iconv('UTF-8', 'GBK', $baseName);
            }

            $fullName = $uploadPath . uniqid() . '_' . $baseName . '.' . $upload->extension;
            $thumbName = $uploadPath . uniqid() . '_' . $upload->baseName . '.' . $upload->extension;
            if(! $upload->saveAs($fullName)) {
                $this->addError('thumb', yii::t('app', 'Upload {attribute} error: ' . $upload->error, ['attribute' => yii::t('app', 'Thumb')]) . ': ' . $thumbName);
                return false;                
            }

            $this->thumb = str_replace(yii::getAlias('@backend/web'), '', $thumbName);
        }*/
        $this->thumb = $this->uploadOpreate();

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