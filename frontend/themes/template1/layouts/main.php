<?php 

use yii\helpers\Html;
use frontend\themes\template1\assets\AppAsset;
use common\models\Config;
use yii\helpers\Url;

AppAsset::register($this);
$configData = Yii::$app->controller->configData;
$this->title = $configData['system_name'];

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= $configData['seo_keyword']?>">
    <meta name="description" content="<?= $configData['seo_description']?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>
	    var _hmt = _hmt || [];
	    (function() {
	      var hm = document.createElement("script");
	      hm.src = "https://hm.baidu.com/hm.js?60f3353ae7e11b1a627fb56ad4072c54";
	      var s = document.getElementsByTagName("script")[0]; 
	      s.parentNode.insertBefore(hm, s);
	    })();
    </script>
    <?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>
	<header>
	  <div id="logo"><a href="/"></a></div>
	  <nav class="topnav" id="topnav">
	  	<a href="index.html"><span>首页</span><span class="en">Protal</span></a>
	  	<a href="about.html"><span>关于我</span><span class="en">About</span></a>
	  	<a href="newlist.html"><span>慢生活</span><span class="en">Life</span></a>
	  	<a href="moodlist.html"><span>碎言碎语</span><span class="en">Doing</span></a>
	  	<a href="share.html"><span>模板分享</span><span class="en">Share</span></a>
	  	<a href="knowledge.html"><span>学无止境</span><span class="en">Learn</span></a>
	  	<a href="book.html"><span>留言版</span><span class="en">Gustbook</span></a></nav>
	  </nav>
	</header>
	<?= $content ?>
	<footer>
	  <p><?= $configData['icp']?>&nbsp;Copyright &copy; <?= date('Y') ?> <?= $this->title ?> </p>
	</footer>
	<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>