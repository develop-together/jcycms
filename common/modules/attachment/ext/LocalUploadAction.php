<?php
namespace common\modules\attachment\ext;

use Yii;
use yii\base\Action;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use common\base\Utils;
use common\models\Upload;

/**
* 上传文件Action
* @author atuxe <atuxe@atuxe.com>
*/
class LocalUploadAction extends Action
{
	/**
	 * 上传类型 可选值：common|ueditor
	 * @var string
	 */
	public $uploadType = 'common';

	/**
	 * 文件表单名称
	 * @var string
	 */
	public $fieldName = 'file';

    /**
     * 上传类型
     * @var string
     */
    public $type = 'upload';

    /**
     * [$config description]
     * @var array
     */
    public $config = [];

	public function run($action='') {
        $_config = require(__DIR__ . '/config.php');
        $this->config = ArrayHelper::merge($_config, $this->config);

        if ($this->uploadType == 'common') {
        	$this->commonUpload();
        } else {
        	$this->ueditorUpload($action);
        }
    }

    protected function commonUpload()
    {
    	if (Utils::method() == 'POST' && isset($_FILES[$this->fieldName])) {

            $config = [
                "pathFormat" => $this->config['filePathFormat'],
                "maxSize" => $this->config['imageMaxSize'],
                "allowFiles" => $this->config['fileAllowFiles'],
            ];

            try {
                $up = new Uploader($this->fieldName, $config, $this->type);
                $info = $up->getFileInfo();
                if (is_array($info)) {
                    $model = new Upload();

                    $model->user_id = Yii::$app->user->identity->id;
                    $model->file_name = $info['url'];
                    $model->thumb_name = $info['thumb_path'];
                    $model->real_name = $info['original'];
                    $model->file_ext = trim($info['type'], '.');
                    $model->file_mime = $info['mime'];
                    $model->file_size = $info['size'];
                    $model->save_path = $info['savePath'];
                    $model->save_name = $info['title'];
                    $model->hash = $info['hash'];

                    $fileName = $info['url'];
                    if ($info['thumb_path']) {
                        $fileName = $info['thumb_path'];
                    }

                    if ($model->save()) {
                        Utils::callback([
                            'success' => 'Done',
                            'message'=>'上传成功',
                            'fileName' => $fileName,
                        ]);
                    } else {
                        @unlink($info['url']);
                        @unlink($info['thumb_path']);
                        throw new Exception("上传成功，但保存文件信息失败");
                    }
                }

            } catch(Exception $ex) {
                exit(JSON::encode([
                    'statusCode' => 300,
                    'message' => $ex->getMessage(),
                    'error' => 1,
                ]));
            }
            
        } else {
        	Utils::callback([
				'message' => '非法请求',
				'state' => '非法请求',
			], 'error');
        }
    }

    protected function ueditorUpload($action) {
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(Yii::$app->basePath . "/../js/ueditor/php/config.json")), true);
        if ($action == 'config') {
        	$result =  json_encode($CONFIG);
        }

        if (Utils::method() == 'POST' && isset($_FILES[$this->fieldName])) {
            try {
                $file = XUpload::upload($_FILES[$this->fieldName]);
                if (is_array($file)) {
                    $model = new Upload();
                    $model->user_id = Yii::$app->user->identity->id;
                    $model->file_name = $file['pathname'];
                    $model->thumb_name = $file['paththumbname'];
                    $model->real_name = $file['name'];
                    $model->file_ext = $file['extension'];
                    $model->file_mime = $file['type'];
                    $model->file_size = $file['size'];
                    $model->save_path = $file['savepath'];
                    $model->hash = $file['hash'];
                    $model->save_name = $file['savename'];
                    if ($model->save()) {
                        $result = (CJSON::encode(array(
                            "state" => 'SUCCESS',
                            "url" => Utils::baseUrl('qiniu') . '/' . $model->file_name,
                            "title" => $model->real_name,
                            "original" => $model->real_name,
                            "type" => $model->file_ext,
                            "size" => $model->file_size,
                        )));
                    } else {
                        @unlink($file['pathname']);
                        @unlink($file['paththumbname']);
                        throw new Exception("上传成功，但保存文件信息失败");
                        
                    }
                } else {
                    throw new Exception("上传错误，请检查网站的上传设置中是否允许该类型的文件");
                    
                }
            } catch(Exception $ex) {
                $result = (CJSON::encode(array(
                    'statusCode' => 300,
                    'state' => $ex->getMessage(),
                )));
            }
            
        }        

        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }
    }
}

 ?>