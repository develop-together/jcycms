<?php

use yii\helpers\Html;
use frontend\themes\template1\assets\AppAsset;
use frontend\widgets\MenuView;
use yii\helpers\Url;

AppAsset::register($this);
$this->title = Yii::$app->jcore->system_name;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=10,IE=9,IE=8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <!-- <meta name="author" content="soulteary@gmail.com"> -->
    <!-- <meta name="robots" content="index, follow"> -->
    <!-- <meta property="og:title" content=""> -->
    <!-- <meta property="og:description" content=""> -->
    <!-- <meta property="og:type" content="article"> -->
    <!-- <meta property="og:url" content=""> -->
    <!-- <meta property="article:published_time" content="2019-02-28T00:00:00+00:00"> -->
    <!-- <meta property="article:modified_time" content="2019-02-28T00:00:00+00:00"> -->
    <meta property="og:image" content="图片地址" /> <!-- facebook -->
    <!-- <meta name="twitter:card" content="summary"> -->
    <!-- <meta name="twitter:description" content=""> -->
	<meta name="twitter:image" content="图片地址" /> <!-- twitter -->
    <meta name="keywords" content="<?= Yii::$app->jcore->seo_keyword ?>">
    <meta name="description" content="<?= Yii::$app->jcore->seo_description ?>">
    <?= Html::csrfMetaTags() ?>
    <style type="text/css" media="screen">
    </style>
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
	<header id="header">
		<div class="navbox">
			<div id="logo" class='logo'><a href="/"></a></div>
			<?= MenuView::widget([]);?>
			<div style="clear: both;"></div>
		</div>
	</header>
	<?= $content ?>
	<footer>
	  <p><?= Yii::$app->jcore->icp ?>&nbsp;Copyright &copy; <?= date('Y') ?> <?= $this->title ?> </p>
	</footer>
	<div class="rollto" id="rolltoBtn" style="display: none;" title="回到顶部">
    	<span><i class="fa fa-arrow-up"></i></span>
	</div>
	<?php $this->endBody() ?>
	<script>
		(function(){
			window.onscroll = function(event) {
				var e = e || window.event;
				var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
				var header = document.getElementById('header');
				var rolltoBtn = document.getElementById('rolltoBtn');
				if (scrolltop > header.offsetHeight) {
					rolltoBtn.style.display = 'block';
				} else {
					rolltoBtn.style.display = 'none';
				}
			}

			document.getElementById('rolltoBtn').onclick = function(event) {
				var scrolltop = document.documentElement.scrollTop || document.body.scrollTop;
				var speed = 500;
				var timer = null;
				timer = setInterval(function() {
					  if ( scrolltop <= 0 ) {
					  	 clearInterval(timer);
					  } else {
					  	 scrolltop -= speed;
					  	 document.body.scrollTop = document.documentElement.scrollTop = scrolltop;
					  }
				}, 300);
			}

			<?php
				if (Yii::$app->getSession()->hasFlash('error')) {
				    $info = addslashes( Yii::$app->getSession()->getFlash('error') );
				    echo "layer.msg('$info', {icon: 5});";
				}

				if (Yii::$app->getSession()->hasFlash('success')) {
					$info = addslashes( Yii::$app->getSession()->getFlash('success') );
					echo "layer.alert('$info', {icon: 6})";
				}

			 ?>
		})()
	</script>
</body>
<?php $this->endPage() ?>