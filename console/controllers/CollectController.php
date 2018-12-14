<?php 
namespace console\controllers;

use Yii;
use common\models\Category;
use console\helpers\collects\Bole;
use console\helpers\HttpClient;
use console\models\Article;
use console\models\CollectTask;
use yii\helpers\FileHelper;
use yii\console\Controller;

class CollectController extends Controller
{
	private $fileName;

	public function actionBole($type = 'all')
	{
		$startTime = time();
		$articleNum = 0;
		$this->log("Started collect...", 'bole');
        $urls = [
        	'http://www.php.cn/article.html',
            'http://web.jobbole.com/all-posts',
            'http://python.jobbole.com/all-posts',
            'http://www.importnew.com/all-posts',
            'http://blog.jobbole.com/category/php-programmer',
        ];
        $bole = new Bole();
        $client = new HttpClient();
        foreach ($urls as $url) {
        	$tryCount = 0;
        	do {
        		if ($tryCount >= 10) {
        			$this->log("Error at request $url for $tryCount times, exit");
        			exit(1);
        		}

        		if ($tryCount > 0) {
        			sleep(1);
        		}

        		$html = $client->post($url)->content;
        	} while (strlen($html['body']) < 200);
        	$totalPage = $bole->getTotalPage($html['body']);
        	$articleUrls = $bole->getListUrl($html['body']);
        	var_dump($totalPage, $articleUrls);
        }
	}

	public function actionPhpcn()
	{

	}


    private function log($str, $name = null)
    {
        if ($name != null) {
            FileHelper::createDirectory(Yii::getAlias("@runtime") . '/logs/collcet/' . $name);
            $this->fileName = Yii::getAlias("@runtime") . '/logs/collcet/' . $name . '/' . date('Y-m-d-h-i-s') . '.log';
        }
        $log = "\r\n" . date('Y-m-d H:i:s') . "   " . $str . "\r\n";
        $this->stdout($log);
        file_put_contents($this->fileName, $log, FILE_APPEND);
    }
}