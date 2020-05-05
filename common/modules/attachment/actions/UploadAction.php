<?php

namespace common\modules\attachment\actions;

use Yii;
use yii\base\Action;
use yii\web\Response;
use yii\web\UploadedFile;
use common\modules\attachment\ext\YiiUploader;

/**
 * Class UploadAction
 * @package common\modules\attachment\actions
 */
class UploadAction extends Action
{
    /**
     * @var
     */
    public $path;

    /**
     * @var bool
     */
    public $uploadOnlyImage = true;

    /**
     * @var bool
     */
    public $multiple = false;

    /**
     * @var null
     */
    public $base64Data = null;

    /**
     * @var array
     */
    public $deleteUrl = ['/upload/delete'];

    /**
     * @var string
     */
    public $uploadQueryParam = 'fileparam';

    /**
     * @var string
     */
    public $uploadParam = '';

    /**
     * @var array
     */
    public $uploadData = [];

    /**
     * @var string
     */
    public $allowUploadFileType = '';

    /**
     * @var string
     */
    private $_validator = 'image';

    /**
     * @var array
     */
    public $validatorOptions = [];

    public $itemCallback = null;

    /**
     *
     */
    public function init()
    {
        $uploadParam = Yii::$app->request->get($this->uploadQueryParam, '');
        if ($uploadParam) $this->uploadParam = $uploadParam;
        if ($this->uploadOnlyImage !== true) $this->_validator = 'file';
        $pathFix = Yii::$app->request->get('pathFix', '');
        if ($pathFix && $this->path) $this->path = $pathFix . '/' . $this->path;
    }

    /**
     * @return array|bool
     */
    public function run()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $files = UploadedFile::getInstanceByName($this->uploadParam);
            if (empty($files)) {
                return ['stateInfo' => '找不到上传的文件', 'statusCode' => 300];
            }

            return $this->uploadOne($files);
        }
    }

    /**
     * @param UploadedFile $file
     * @return array|bool
     */
    private function uploadOne(UploadedFile $file)
    {
        //默认设置
        if ('image-upload' === $this->id) {
            $config['maxSize'] = Yii::$app->params['uploadConfig']['imageMaxSize'];
            $config['allowFiles'] = Yii::$app->params['uploadConfig']['imageAllowFiles'];
            $config['mimeMap'] = Yii::$app->params['uploadConfig']['imgAllowFileMimes'];
        } else {
            $config['maxSize'] = Yii::$app->params['uploadConfig']['fileMaxSize'];
            $config['allowFiles'] = Yii::$app->params['uploadConfig']['fileAllowFiles'];
        }

        $uploader = new YiiUploader($file, $config, $this->path);
        $res = $uploader->upload();
        if (false === $res) {
            return ['stateInfo' => $uploader->getStateInfo(), 'statusCode' => 300];
        }

        return $res;
    }
}
