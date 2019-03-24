<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use frontend\widgets\ArticleListView;
	use frontend\models\Article;
	use yii\data\ArrayDataProvider;

	$this->title = $model->title;
	$this->params['breadcrumbs'] = [
	    [
	      'label' => Yii::t('frontend', 'Home'),
	      'url' => '/',
	      'class' => 'n1'
	    ],
	    [
	      'label' => $model->category->name,
	      'url' => 'article/index/' . $model->category->name,
	      'class' => 'n1'
	    ],
	    ['label' => $this->title],
	  ];
?>

<article class="blogs">
	<?= $this->render('/widgets/_navigation') ?>
 	<div class="index_about">
		<h2 class="c_titile"><?= $model->title ?></h2>
		<p class="box_c">
			<span class="d_time"><?= Yii::t('frontend', 'Created At') ?>：<?= $model->created_at ?></span>
			<span><?= Yii::t('frontend', 'Author') ?>：<?= $model->user->penname ?></span>
			<span><?= Yii::t('frontend', 'View count')?>：<b id="scan_count" style="display: none"><?= $model->getScan_count() ?></b></span>
		</p>
		<div class="infos">
			<?= $model->content ?>
		</div>
	    <div class="keybq">
	    	<p><span><?= Yii::t('frontend', 'Keywords') ?></span>：<?= $model->tag ?></p>
	    </div>
	    <div class="ad"> </div>
		<div class="nextinfo">
			<?php if ($prevModel): ?>
				<p><?= Yii::t('frontend', 'previous') ?>：<?= Html::a($prevModel->title, Url::to(['acticle/view', 'id' => $prevModel->id]), ['title' => $prevModel->sub_title, 'target' => '_self']) ?></p>
			<?php endif ?>
			<?php if ($nextModel): ?>
			<p><?= Yii::t('frontend', 'next') ?>：<?= Html::a($nextModel->title, Url::to(['acticle/view', 'id' => $nextModel->id]), ['title' => $nextModel->sub_title, 'target' => '_self']) ?></p>
			<?php endif ?>
		</div>
		<div class="otherlink">
		    <?= ArticleListView::widget([
		        'dataProvider' => new ArrayDataProvider([
		            'allModels' => Article::find()->where(['category_id' => $model->category_id])->limit(6)->all(),
		         ]),
		        'layout' => '<h2>' . Yii::t('frontend', 'About Articles') . '</h2><ul>{items}</ul>',
		        'template' => '<a href="{viewUrl}" title="{title}">{title}</a>',
		        'itemOptions' => ['tag'=>'li'],
		    ]) ?>
		</div>
 	</div>
	<aside class="right">
	<!-- Baidu Button BEGIN -->
	<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
	<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
	<script type="text/javascript" id="bdshell_js"></script>
	<script type="text/javascript">
	document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
	</script>
	<!-- Baidu Button END -->
	<div class="blank"></div>
	<div class="news">
	    <?= ArticleListView::widget([
	        'dataProvider' => new ArrayDataProvider([
	            'allModels' => Article::find()->limit(8)->orderBy(['created_at' => SORT_DESC])->all(),
	         ]),
	        'layout' => '<h3><p>' . Yii::t('frontend', 'Newest') . '<span>' . Yii::t('frontend', 'Article') . '</span></p></h3><ul class="rank">{items}</ul>',
	        'template' => '<a href="{viewUrl}" title="{title}">{title}</a>',
	        'itemOptions' => ['tag'=>'li'],
	    ]) ?>
	    <?= ArticleListView::widget([
	        'dataProvider' => new ArrayDataProvider([
	            'allModels' => Article::find()->limit(6)->orderBy(['scan_count' => SORT_DESC])->all(),
	         ]),
	        'layout' => '<h3 class="ph"><p>' . Yii::t('frontend', 'click') . '<span>' . Yii::t('frontend', 'Ranking') . '</span></p></h3><ul class="paih">{items}</ul>',
	        'template' => '<a href="{viewUrl}" title="{title}">{title}</a>',
	        'itemOptions' => ['tag'=>'li'],
	    ]) ?>
	</div>
	<div class="visitors">
	  <h3>
	    <p>最近访客</p>
	  </h3>
	  <ul>
	  </ul>
	</div>
	</aside>
</article>
<?php
	$ajaxurl = Url::to(['article/view-ajax']);
	$this->registerJs(<<<JS
		$(document).ready(function() {
			$("#scan_count").show()
			$.ajax({
				url: "$ajaxurl",
				data: {id: $model->id},
				success: function(res) {
					$("#scan_count").text(res.scan_count)
				}
			})
		})
JS
);
?>