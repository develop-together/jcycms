<?php 

use yii\helpers\Html;
use frontend\themes\template2\assets\AppAsset;
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
	  <div class="logo"><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/logo.png"></a></div>
	  <nav id="nav">
	    <ul>
	      <li><a href="index.html">网站首页</a></li>
	      <li><a href="share.html">我的相册</a></li>
	      <li><a href="list.html">我的日记</a></li>
	      <li><a href="about.html">关于我</a></li>
	      <li><a href="gbook.html">留言</a></li>
	      <li><a href="info.html">内容页</a></li>
	      <li><a href="infopic.html">内容页</a></li>
	    </ul>
	  </nav>    
	</header>
	<div class="mnav">
	    <ul>
	      <li><a href="index.html">首页</a></li>
	      <li><a href="share.html">相册</a></li>
	      <li><a href="list.html">日记</a></li>
	      <li><a href="about.html">关于</a></li>
	      <li><a href="gbook.html">留言</a></li>
	      <li><a href="info.html">内容页</a></li>
	      <li><a href="infopic.html">内容页</a></li>
	    </ul>
  	</div>
	<?= $content ?>
	<footer>
	  <p><?= $configData['icp']?>&nbsp;Copyright &copy; <?= date('Y') ?> <?= $this->title ?></p>
	</footer>
	<?php $this->endBody() ?>
	<script>
		var obj=null;
		var As=document.getElementById('nav').getElementsByTagName('a');
		obj = As[0];
		for (i = 1; i < As.length; i++) {
			if (window.location.href.indexOf(As[i].href) >= 0) obj = As[i];
		}
		obj.id = 'selected';
	</script>
</body>
</html>
<?php $this->endPage() ?>