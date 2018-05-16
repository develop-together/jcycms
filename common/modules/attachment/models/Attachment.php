<?php

namespace common\modules\attachment\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\base\Exception;
use yii\helpers\FileHelper;
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
    /**
     * @inheritdoc
     */
    private $uploadPath = '';

    public static function tableName()
    {
        return '{{%attachment}}';
    }

    public function behaviors()
    {
        $behaviors = [];
        if($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
            $behaviors[] = TimestampBehavior::className();
        }

        return $behaviors;
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
            'ip' => 'Ip',
            'web' => 'Web',
            'downci' => Yii::t('common', 'Downci'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
        ];
    }

    public  function uploadFormPost($path, $uploadData)
    {

       if ($uploadData !== null) {
            $this->uploadPath = Yii::getAlias('@backend') . '/web/' . Yii::$app->params['uploadSaveFilePath'] . '/' . $path;  
            if (!FileHelper::createDirectory($this->uploadPath)) {
                $this->addError('thumb', 'Create directory failed' . $this->uploadPath);
                return false;
            }      
            $relativeUploadPath = Yii::$app->params['uploadSaveFilePath'] . '/'. $path;
            $newName = $this->uniqidFilename($relativeUploadPath);
            $fullName = $this->uploadPath . '/' . $newName . '.' . $uploadData->extension;
            if (!$uploadData->saveAs($fullName)) {
                $this->addError('avatar', yii::t('app', 'Upload {attribute} error: ' . $uploadData->error, ['attribute' => yii::t('app', 'Avatar')]) . ': ' . $fullName);
                return false;
            }
/*            $this->user_id = Yii::$app->user->id;
            $this->filename = $uploadData->name;
            $this->filetype = $uploadData->type;
            $this->extension = $uploadData->extension;
            $this->filesize = $uploadData->size;
            $this->filesizecn = $this->getFileSizeFormat();
            $this->filepath = $path . '/' . $newName . '.' . $uploadData->extension;
            $this->ip = Yii::$app->request->userIP;
            $this->web = $this->getbrowser();
            if (!$this->save()) {
                @unlink($this->uploadPath . '/' . $this->filepath);
                $err = [];
                foreach($this->getErrors() as $error) {
                    $err[] = $error[0];
                }
                throw new Exception('上传失败(原因:' . implode("\n", $err). ')');
            }

            return true;*/
            $this->filepath = $relativeUploadPath . '/' . $newName . '.' . $uploadData->extension;

            return $this->saveAttachments($uploadData);

       } 
   }

   public function saveAttachments($uploadData, $filepath = '', $uploadPath = '')
   {

        $this->user_id = Yii::$app->id == 'app-backend' ? Yii::$app->user->id : User::SUPER_MANAGER;
        $this->filename = $uploadData->name;
        $this->filetype = $uploadData->type;
        $this->extension = $uploadData->extension;
        $this->filesize = $uploadData->size;
        $this->filesizecn = $this->getFileSizeFormat();
        $this->uploadPath = !$uploadPath ? $this->uploadPath : $uploadPath;
        $this->filepath = !$filepath ? $this->filepath : $filepath;
        $this->ip = Yii::$app->request->userIP;
        $this->web = $this->getbrowser();
        if (!$this->save()) {
            @unlink($this->uploadPath . '/' . $this->filepath);
            $err = [];
            foreach($this->getErrors() as $error) {
                $err[] = $error[0];
            }

            throw new Exception('上传失败(原因:' . implode("\n", $err). ')');

            return false;
        } 

        return true;
   }
    // $this->uploadPath = Yii::getAlias('@backend') . '/web/' . Yii::$app->params['uploadSaveFilePath'] . '/' . $path;
    // if(!is_dir($this->uploadPath)) {
    //     mkdir($this->uploadPath, 0777, true);
    // }        
    // var_dump($uploadData);exit;
    // $extArr = explode('/', trim($uploadData['fileType']));
    // $extension = end($extArr);
    // $fileNewName = md5(time());
    // $this->user_id = Yii::$app->user->id;
    // $this->filename = $uploadData['fileName'];
    // $this->filetype = $uploadData['fileType'];
    // $this->extension = $extension;
    // $this->filesize = $uploadData['fileSize'];
    // $this->filesizecn = $this->getFileSizeFormat();
    // $this->filepath = $path . '/' . $this->base64ToFile($uploadData['base64Data'], $fileNewName);
    // $this->ip = Yii::$app->request->userIP;
    // $this->web = $this->getbrowser();
    // if (!$this->save()) {
    //     @unlink($this->uploadPath . '/' . $this->filepath);
    //     $err = [];
    //     foreach($this->getErrors() as $error) {
    //         $err[] = $error[0];
    //     }
    //     throw new Exception('上传失败(原因:' . implode("\n", $err). ')');
    // }

    // return true;

    public function base64ToFile($base64String, $outputFile) 
    {
        $base64String = explode(',', $base64String); //data:image/jpeg;base64,
        $imgInfo = explode(';', $base64String[0]); //[data:image/jpeg,base64]
        $imgInfo = explode(':', $imgInfo[0]); //[data,image/jpeg]
        $imgInfo = explode('/', end($imgInfo));
        $fileExt = end($imgInfo);
        $outputFile = $outputFile . '.' . $fileExt;
        file_put_contents($this->uploadPath . '/' . $outputFile, base64_decode(end($base64String))); //返回的是字节数

        return $outputFile;

    }

    public function getFileSizeFormat()
    {
        $arr = ['Byte', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $e = floor(log($this->filesize)/log(1024));

        return number_format(($this->filesize/pow(1024,floor($e))),2,'.','').' '.$arr[$e];
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
            if(strpos($web, $wp[0]) !== false){
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

    private function uniqidFilename($path)
    {
        $filepath = $path . '/' . md5(time());
        $model = Attachment::findOne(['filepath' => $filepath]);
        if ($model) {
            return $this->uniqidFilename($path);
        }

        return str_replace($path . '/', '', $filepath);
    }    
}
