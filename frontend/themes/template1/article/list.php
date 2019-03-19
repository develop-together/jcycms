<?php
  use yii\helpers\Url;
  use frontend\widgets\ArticleListView;
  use frontend\widgets\Pjax;
  use frontend\models\Carousel;
  use frontend\models\Article;
  use frontend\models\FriendLink;
  use yii\data\ArrayDataProvider;
 ?>

 <article class="blogs">
 	<h1 class="t_nav">
 		<span>“慢生活”不是懒惰，放慢速度不是拖延时间，而是让我们在生活中寻找到平衡。</span>
 		<a href="/" class="n1">网站首页</a><a href="/" class="n2">慢生活</a>
 	</h1>
     <?php
      echo ArticleListView::widget([
        'titler' => '<h2 class="title_tj"><p>' . $cate->name . '</p></h2>',
        'dataProvider' => $dataProvider
      ]);

    ?>
  <aside class="right">
    <div class="rnav">
      <ul>
        <li class="rnav1"><a href="/download/" target="_blank">日记</a></li>
        <li class="rnav2"><a href="/newsfree/" target="_blank">程序人生</a></li>
        <li class="rnav3"><a href="/web/" target="_blank">欣赏</a></li>
        <li class="rnav4"><a href="/newshtml5/" target="_blank">短信祝福</a></li>
      </ul>
    </div>
    <div class="news">
	    <?= ArticleListView::widget([
	        'dataProvider' => new ArrayDataProvider([
	            'allModels' => Article::find()->where(['type' => Article::ARTICLE])->limit(6)->orderBy(['scan_count' => SORT_DESC])->all(),
	         ]),
	        'layout' => '<h3 class="ph"><p>' . Yii::t('frontend', 'click') . '<span>' . Yii::t('frontend', 'Ranking') . '</span></p></h3><ul class="paih">{items}</ul>',
	        'template' => '<a href="{article_url}" title="{title}">{title}</a>',
	        'itemOptions' => ['tag'=>'li'],
	    ]) ?>
	    <div class="visitors">
	      <h3>
	        <p>最近访客</p>
	      </h3>
	      <ul>
	      </ul>
	    </div>
    </div>
	</aside>
 </article>