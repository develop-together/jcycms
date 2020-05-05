<?php

namespace common\widgets\fileUploadInput;

use common\components\Utils;
use Yii;
use yii\base\Arrayable;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;
use common\modules\attachment\models\Attachment;
use common\modules\attachment\assets\AttachmentUploadAsset;

/**
 * Class MultipleWidget
 * @package common\widgets\fileUploadInput
 */
class MultipleWidget extends InputWidget
{
    /**
     * @var bool
     */
    public $onlyImage = true;

    /**
     * @var
     */
    public $wrapperOptions;

    // 客户端选项,构成$clientOptions
    /**
     * @var array
     */
    public $clientOptions = [];

    //上传URL地址
    /**
     * @var string
     */
    public $url = '';

    // 这里为了配合后台方便处理所有都是设为true,文件上传数目请控制好 $maxNumberOfFiles
    /**
     * @var bool
     */
    public $multiple = true;

    //允许上传的最大文件数目
    /**
     * @var int
     */
    public $maxNumberOfFiles = 50;

    //允许上传最大限制
    /**
     * @var
     */
    public $maxFileSize;

    //允许上传附件的类型
    /**
     * @var
     */
    public $acceptFileTypes;

    //删除上传附件的URL
    /**
     * @var string
     */
    public $deleteUrl = 'upload/delete';

    /**
     * @var
     */
    public $fileInputName;

    /**
     * @var bool
     */
    public $onlyUrl = false;

    /**
     * @var
     */
    public $parentDivId;

    /**
     * @var bool
     */
    public $many = false;

    /**
     * @var string
     */
    public $notes = '';

    public $pathFix = '';

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (empty($this->url)) {
            if ($this->onlyImage === false) {
                $this->url = $this->multiple ? '/upload/backend-files-upload' : '/upload/file-upload';
            } else {
                $this->url = $this->multiple ? '/upload/images-upload' : '/upload/image-upload';
                $this->acceptFileTypes = 'image/png, image/jpg, image/jpeg, image/gif, image/bmp';
            }
        }

        if ($this->hasModel()) {
            $this->name = $this->name ?: Html::getInputName($this->model, $this->attribute);
            $this->attribute = Html::getAttributeName($this->attribute);
            $value = $this->formatAttachment($this->model->{$this->attribute});
            $this->value = $value;
//            $this->value[] = $value;
        }

        $this->fileInputName = md5($this->name);
        $this->parentDivId = 'Res-' . time();
        $this->clientOptions = ArrayHelper::merge($this->clientOptions, [
            'hiddenInputId' => $this->options['id'],
            'url' => Url::toRoute([$this->url, 'fileparam' => $this->fileInputName, 'pathFix' => $this->pathFix]),
            'deleteUrl' => urlencode(Url::toRoute([$this->deleteUrl, 'table' => $this->model->tableName(), 'attribute' => $this->attribute])),
            'multiple' => $this->multiple,
            'maxNumberOfFiles' => $this->maxNumberOfFiles,
            'maxFileSize' => $this->maxFileSize,
            'acceptFileTypes' => $this->acceptFileTypes,
            'files' => $this->value ?: [],
            'many' => $this->many
        ]);
    }

    /**
     * @param $attachment
     * @return array
     */
    protected function formatAttachment($attachment)
    {
        $arr = [];
        $attachmentModel = null;
        if (!empty($attachment) && is_string($attachment)) {
            /* @var Attachment $attachmentModel */
            $attachmentModel = Attachment::find()
                ->select(['id', 'filetype'])
                ->where(['filepath' => $attachment])
                ->orderBy(['id' => SORT_DESC])
                ->One();
            $da = [
                'url' => Utils::photoUrl($attachment),//Yii::$app->request->hostInfo . '/' . $attachment,
                'fullname' => $attachment,
            ];
            if ($attachmentModel) {
                $da['id'] = $attachmentModel->id;
                $da['filetype'] = $attachmentModel->filetype;
            }
            $arr[] = $da;
        } else if (is_array($attachment)) {
            $attachment = array_map(function ($att) {
                if (is_string($att)) {
                    /* @var Attachment $attachmentModel */
                    $attachmentModel = Attachment::find()
                        ->select(['id', 'filetype'])
                        ->where(['filepath' => $att])
                        ->orderBy(['id' => SORT_DESC])
                        ->One();
                    if ($attachmentModel === null)
                        return [
                            'url' => Utils::photoUrl($att),
                            'fullname' => $att,
                            'id' => 0,
                            'filetype' => 'image/jpeg'
                        ];
                    return [
                        'url' => Utils::photoUrl($att),
                        'fullname' => $att,
                        'id' => $attachmentModel->id,
                        'filetype' => $attachmentModel->filetype,
                    ];
                } elseif ($att instanceof Attachment) {
                    return [
                        'url' => Utils::photoUrl($att->filepath),
                        'fullname' => $att->filepath,
                        'id' => $att->id,
                        'filetype' => $att->filetype,
                    ];
                }
            }, $attachment);

            return $attachment;
        }

        return $arr;
    }

    /**
     * @return string
     */
    public function run()
    {
        $this->registerClientScript();
        $inputPix = $this->multiple ? '[]' : '';
        $content = '';
        $content = Html::hiddenInput($this->name . $inputPix, null, $this->options);
        $this->wrapperOptions = ArrayHelper::merge(['id' => $this->parentDivId], $this->wrapperOptions);
        $content .= Html::beginTag('div', $this->wrapperOptions);
        $options = Json::encode($this->clientOptions);
        $content .= Html::fileInput($this->fileInputName, null, [
            // 'id' => $this->fileInputName,
            'multiple' => $this->multiple,
            'accept' => $this->acceptFileTypes,
            'onchange' => "ajaxUpload(this,'" . $this->parentDivId . "')",
            'data-options' => $options,
        ]);

        $content .= Html::endTag('div');
        if (!empty($this->notes)) {
            $content .= Html::tag('span', $this->notes);
        }
        return $content;
    }

    /**
     *
     */
    public function registerClientScript()
    {
        Html::addCssClass($this->wrapperOptions, "upload-kit-input");
        AttachmentUploadAsset::register($this->getView());
    }
}
	