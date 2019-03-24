<?php

  use yii\helpers\Url;
  use frontend\widgets\ArticleListView;
  use frontend\widgets\Pjax;
  use frontend\models\Carousel;
  use frontend\models\Article;
  use frontend\models\FriendLink;
  use yii\data\ArrayDataProvider;
?>

<div class="banner">
  <section class="box">
    <ul class="texts">
      <p>打了死结的青春，捆死一颗苍白绝望的灵魂。</p>
      <p>为自己掘一个坟墓来葬心，红尘一梦，不再追寻。</p>
      <p>加了锁的青春，不会再因谁而推开心门。</p>
    </ul>
    <div class="avatar"><a href="#"><span>JCY</span></a> </div>
  </section>
</div>
<div class="template">
  <div class="box">
    <h3><p><span><?= Yii::t('frontend', 'Recommended blog Templates') ?></span> </p></h3>
    <?php
        $templates = Carousel::getTeamplates();
        if ($templates) {
          echo '<ul>';
          foreach ($templates as $teamplate) {
            echo "<li><a href='" . $teamplate->url . "'  target='_blank'><img src='" . $teamplate->image . "'></a><span>" . $teamplate->caption . "</span></li>";
          }
          echo '</ul>';
        }
     ?>
  </div>
</div>
<?php
  Pjax::begin(['id' => 'countries-article']);
 ?>
<article>
    <?php
      echo ArticleListView::widget([
        'titler' => '<h2 class="title_tj"><p>文章<span>推荐</span></p></h2>',
        'dataProvider' => $dataProvider
      ]);
    ?>
  <aside class="right">
    <div class="weather">
      <iframe width="250" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=1"></iframe>
    </div>
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
    <h3 class="links">
      <p><?= Yii::t('frontend', 'Friendship') ?><span><?= Yii::t('frontend', 'Link') ?></span></p>
    </h3>
    <?php
        $links = FriendLink::find()->where(['status' => FriendLink::DISPLAY_YES])->limit(4)->orderBy(['id' => SORT_DESC])->all();
        if ( $links ) {
          echo '<ul class="website">';
          foreach ($links as  $link) {
            echo "<li><a href=\"{$link->url}\">{$link->name}</a></li>";
          }
          echo '</ul>';
        }

     ?>
    </div>
    <!-- Baidu Button BEGIN -->
    <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
    <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
    <script type="text/javascript" id="bdshell_js"></script>
    <script type="text/javascript">
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
    <!-- Baidu Button END -->
    <a href="/" class="weixin"> </a></aside>
</article>
<?php
  Pjax::end();
 ?>