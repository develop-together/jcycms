<?php
/**
 * 基于yii2的上传组件
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-06-20 19:56:09
 */
namespace common\modules\attachment\ext;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use common\modules\attachment\models\Attachment;
use common\components\Utils;
use common\components\ImageHelper;

class YiiUploader 
{
	//上传状态映射表，国际化用户需考虑此处数据的国际化
    private $stateMap = [];
    // 默认的文件mimetype
    private $mimeMap = [
		//applications
		// 'application/postscript',
		// 'application/postscript',
		// 'application/octet-stream',
		'application/vnd.ms-word',
		'application/vnd.ms-excel',
		'application/vnd.ms-powerpoint',
		'application/vnd.ms-powerpoint',
		'application/pdf',
		'application/xml',
		'application/vnd.oasis.opendocument.text',
		// 'application/x-shockwave-flash',
		// archives
		// 'application/x-gzip',
		// 'application/x-gzip',
		// 'application/x-bzip2',
		// 'application/x-bzip2',
		// 'application/x-bzip2',
		'application/zip',
		'application/x-rar',
		// 'application/x-tar',
		'application/x-7z-compressed',
		// texts
		// 'text/plain',
		// 'text/x-php',
		// 'text/html',
		// 'text/html',
		// 'text/javascript',
		// 'text/css',
		// 'text/rtf',
		// 'text/rtfd',
		// 'text/x-python',
		// 'text/x-java-source',
		// 'text/x-ruby',
		// 'text/x-shellscript',
		// 'text/x-perl',
		// 'text/x-sql',
		// images
		'image/x-ms-bmp',
		'image/jpeg',
		'image/jpeg',
		'image/gif',
		'image/png',
		'image/tiff',
		'image/tiff',
		'image/x-targa',
		'image/vnd.adobe.photoshop',
		//audio
		'audio/mpeg',
		'audio/midi',
		'audio/ogg',
		'audio/mp4',
		'audio/wav',
		'audio/x-ms-wma',
		// video
		'video/x-msvideo',
		'video/x-dv',
		'video/mp4',
		'video/mpeg',
		'video/mpeg',
		'video/quicktime',
		'video/x-ms-wmv',
		'video/x-flv',
		'video/x-matroska'
    ];

    // 上传类型
    private $type;
    // yii表单的字段
    private $attribute;
    //上传的目录
	private $uploadPath;
	// 上传的绝对路径
   	private $savePath;
   	// 上传的相对位置
    private $fullName;
    // 上传后的新文件名
    private $fileName;
	// 上传前的文件名
	private $oldFileName;
	// 文件hash散列算法
	private $hashType = 'md5_file';
    // yii2 上传对象 表单上传 $_FILES
	private $uploadedFile;
	// 上传参数
	private $config;
	// 上传状态信息
	private $stateInfo;
	// 文件类型
    private $fileType;
    // 文件大小
    private $fileSize;
    // 文件mimeType
    private $fileMime;
   	// 用于base64上传
    private $base64Str    = '';
    // 是否允许裁剪图片
    private $enableThumb  = false;
    // 是否替换成裁剪的路径
    private $replacePath  = false;
    // 裁剪图片后的宽度
    private $enableWidth  = 220;
    // 裁剪图片后的高度
    private $enableHeight = 160;
    // 缩略图的文件路径
    private $thumbPath;

    private $attachment_id = 0;

    /**
     * [__construct description]
     * @param string $type         [description]
     * @param [type] $uploadedFile [description]
     * @param [type] $config       [description]
     * @param [type] $others       [+attribute, +uploadAlias]
     */
	public function __construct($uploadedFile, $config, $path = '', $type = 'upload', $others = [])
	{
        $this->setStateMap();
        $this->config = $config;
        $this->type = $type;
        $this->uploadedFile = $uploadedFile;
        $this->mimeMap = isset($this->config['mimeMap']) ? $this->config['mimeMap'] : $this->mimeMap;
        $this->path = $path ? $path : date('Ym');
        isset($others['attribute']) && $this->attribute = $others['attribute'];
        isset($others['base64Str']) && $this->base64Str = $others['base64Str'];
        isset($others['enableThumb']) && $this->enableThumb = $others['enableThumb'];
        isset($others['thumbWidth']) && $this->thumbWidth = $others['thumbWidth'];
        isset($others['thumbHeight']) && $this->thumbHeight = $others['thumbHeight'];
        isset($others['replacePath']) && $this->replacePath = $others['replacePath'];
        $this->uploadPath = !isset($others['uploadAlias']) ? Yii::getAlias('@backend') . '/web/' . Yii::$app->params['uploadConfig']['uploadSaveFilePath'] . '/' .  $path : $others['uploadAlias'] .  $path;
	}

    public function upload()
    {   
        if ('base64' === $this->type) {
            return $this->upBase64();
        } else {
            return $this->uploadOneFile();
        }
    }

    private function setStateMap()
    {
        $this->stateMap = [
            "SUCCESS",
            Yii::t('common', 'File size exceeds upload_max_filesize limit'),
            Yii::t('common', 'File size exceeds MAX_FILE_SIZE limit'),
            Yii::t('common', 'The file has not been fully uploaded'),
            Yii::t('common', 'No files were uploaded'),
            Yii::t('common', 'Upload file is empty'),
            "ERROR_TMP_FILE"            => Yii::t('common', 'Temporary file error'),
            "ERROR_TMP_FILE_NOT_FOUND"  => Yii::t('common', 'Temporary file not found'),
            "ERROR_SIZE_EXCEED"         => Yii::t('common', 'File size exceeds site limit'),
            "ERROR_TYPE_NOT_ALLOWED"    => Yii::t('common', 'File type is not allowed'),
            "ERROR_CREATE_DIR"          => Yii::t('common', 'Directory creation failed'),
            "ERROR_DIR_NOT_WRITEABLE"   => Yii::t('common', 'Directory does not have write permission'),
            "ERROR_FILE_MOVE"           => Yii::t('common', 'Error saving file'),
            "ERROR_FILE_NOT_FOUND"      => Yii::t('common', 'Upload file not found'),
            "ERROR_WRITE_CONTENT"       => Yii::t('common', 'Error writing to file content'),
            "ERROR_UNKNOWN"             => Yii::t('common', 'Unknown error'),
            "ERROR_DEAD_LINK"           => Yii::t('common', 'Link not available'),
            "ERROR_HTTP_LINK"           => Yii::t('common', 'The link is not a http link'),
            "ERROR_SAVE_MYSQL"          => Yii::t('common', 'Failed to save database'),
            "ERROR_HTTP_CONTENTTYPE"    => Yii::t('common', 'Link contentType is incorrect')
        ];
    }
	/**
	 * [checkUploadedFile 是否是UploadedFile检查]
	 * @return [type] [description]
	 */
	private function checkUploadedFile()
	{
		return $this->uploadedFile instanceof UploadedFile ? true : false;
	}

    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function returnStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array(strtolower($this->fileType), $this->config["allowFiles"]);
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function checkSize()
    {
        return $this->fileSize <= ($this->config["maxSize"]);
    }

    private function checkIsUploadImg()
    {
        return strpos($this->fileMime, 'image') === 0 ? true : false;
    }

    /**
     * [checkMime 文件mime检查]
     * @return [type] [description]
     */
    private function checkMime($mime = null)
    {   $mime = empty($mime) ? $this->fileMime : $mime;
    	return in_array(strtolower($mime), $this->mimeMap);
    }

    private function checkRealType()
    {
        if (function_exists('getimagesize')) {
            return !@getimagesize($this->savePath) ? false : true;
        }

        return false;
    }

    /**
     * 文件MIME
     */
    private function getFileMime()
    {
        $finfo = finfo_open(FILEINFO_MIME);
        $fileMime = finfo_file($finfo, $this->savePath);
        finfo_close($finfo);

        return explode(';', $fileMime)[0];
    }

    /**
     * [getStateInfo 返回错误信息]
     * @return [type] [description]
     */
    public function getStateInfo()
    {
    	return $this->stateInfo;
    }

    /**
     * [uniqidFilename 创建新文件名]
     * @return [type] [description]
     */
    private function uniqidFilename()
    {
    	return md5(time()) . uniqid();
    }

    /**
     * [getFileSizeFormat 文件大小格式化]
     * @return [type] [description]
     */
    private function getFileSizeFormat()
    {
        $arr = ['Byte', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $e = floor(log($this->fileSize)/log(1024));

        return number_format( ( $this->fileSize / pow( 1024,floor( $e ) ) ), 2, '.', '') .' '.$arr[$e];
    }

    // 自动转换字符集 支持数组转换
    private function autoCharset($fContents, $from='gbk', $to='utf-8') 
    {
        $from   = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
        $to     = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
        if (strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
            //如果编码相同或者非字符串标量则不转换
            return $fContents;
        }
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($fContents, $to, $from);
        } elseif (function_exists('iconv')) {
            return iconv($from, $to, $fContents);
        } else {
            return $fContents;
        }
    }

    /**
     * 文件散列值
     */
    private function getFileHash()
    {
        if(function_exists($this->hashType)) {
            $fun =  $this->hashType;
            return $fun($this->autoCharset($this->savePath, 'utf-8', 'gbk'));
        }
    }

    /**
     * [uploadOneFile 单个文件上传]
     * @return [type] [description]
     */
    private function uploadOneFile()
    {
    	if (empty($this->uploadedFile) || !$this->checkUploadedFile()) {
			$this->stateInfo = $this->returnStateInfo('ERROR_UNKNOWN');
			return false;
    	}

		$this->fileSize = $this->uploadedFile->size;
		$this->fileType = '.' . $this->uploadedFile->extension;
		$this->fileMime = $this->uploadedFile->type;
		$this->oldFileName = $this->uploadedFile->name;

         //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->returnStateInfo("ERROR_SIZE_EXCEED");
            return false;
        }

        //检查是否不允许的文件格式
        if (!$this->checkType()) {
            $this->stateInfo = $this->returnStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return false;               
        }

        //检查是否不允许的文件格式
        if (!$this->checkMime()) {
            $this->stateInfo = $this->returnStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return false;               
        }

        if (! FileHelper::createDirectory($this->uploadPath)) {
            $this->stateInfo = $this->returnStateInfo("ERROR_CREATE_DIR");
            return false;
        } elseif (!is_writable($this->uploadPath)) {
            $this->stateInfo = $this->returnStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return false;        	
        }

        $this->fileName = $this->uniqidFilename() . $this->fileType;
        $this->savePath = $this->uploadPath . '/' . $this->fileName;
        $this->fullName = Utils::getRelativePath($this->savePath);
		if (!$this->uploadedFile->saveAs($this->savePath)) {
			if (!empty($this->attribute)) {
				$this->stateInfo = Yii::t('app', 'Upload {attribute} error: ' . $this->uploadedFile->error, ['attribute' => Yii::t('app', $this->attribute)]);
			} else {
				$this->stateInfo = $this->returnStateInfo("ERROR_WRITE_CONTENT");
			}
		    return false;
		}

         //检查上传后的文件的mimetype，防止修改文件后缀的文件上传
        $real_mime = $this->getFileMime();
        if (!$this->checkMime($real_mime)) {
            $this->stateInfo = $this->returnStateInfo("ERROR_TYPE_NOT_ALLOWED");
            @unlink($this->savePath);
            return false;               
        }

        //图片文件再一次防止修改文件后缀的文件上传
        if ($this->checkIsUploadImg() && !$this->checkRealType()) {
            $this->stateInfo = $this->returnStateInfo("ERROR_TYPE_NOT_ALLOWED");
            @unlink($this->savePath);
            return false;             
        }

		if (true === $this->enableThumb) {
			$this->thumbPath = ImageHelper::thumbnail($this->savePath, $this->thumbWidth, $this->thumbHeight);
			if ($this->replacePath) {
				$this->fullName = $this->thumbPath;
			}
		}

		$attachment = new Attachment();
		$params = [
			'filename' => $this->oldFileName,
			'filetype' => $this->fileMime,
            'filesize' => $this->fileSize,
			'extension' => $this->uploadedFile->extension,
			'filesizecn' => $this->getFileSizeFormat(),
			'filepath' => $this->fullName,
			'filename' => $this->oldFileName,
			'filehash' => $this->getFileHash(),
		];
		if (! ($this->attachment_id = $attachment->saveData($params))) {
			if (!empty($this->attribute)) {
				$this->stateInfo = Yii::t('app', 'Upload {attribute} error: ' . $this->uploadedFile->error, ['attribute' => Yii::t('app', $thisattribute)]);
			} else {
				$this->stateInfo = $this->returnStateInfo("ERROR_SAVE_MYSQL");
			}

			return false;
		}

		$this->stateInfo = $this->stateMap[0];
		return $this->getFileInfo();
    }

    /**
     * [upBase64 base64流上传]
     * @return [type] [description]
     */
    public function upBase64()
    {
        $fileName = $this->uniqidFilename();
        $this->savePath = $this->uploadPath . '/' . $fileName;
		$res = Utils::base64ToFile($this->base64Str, $this->savePath);
		if (!$res) {
			$this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
		    return false;
		}

		$resArr = explode('.', $res);
		$this->fileType = $this->extension = end($resArr);
		$this->fullName = $res;
		$this->oldFileName = $fileName . '.' . $extension;

		return $this->getFileInfo();
    }

    /**
     * 获取当前上传成功文件的各项信息
     * @return array
     */
    public function getFileInfo()
    {
        return [
            "state"         => $this->stateInfo,
            "statusCode"    => 200,
            "url"           => Yii::$app->getRequest()->getHostInfo() . '/' . $this->fullName,
            "fullname"      => $this->fullName,
            "title"         => $this->oldFileName,
            "mimeType"          => $this->fileMime,
            "size"          => $this->fileSize,
            // "savePath"   => $this->savePath,
            "thumb_path"    => $this->thumbPath,
            'attachment_id' => $this->attachment_id
        ];
    }
}