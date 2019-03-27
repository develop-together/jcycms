<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use frontend\widgets\ArticleListView;
	use frontend\models\Article;
	use yii\data\ArrayDataProvider;

	$this->title = $model->title;
	// $this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords], 'keywords');
	// $this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description], 'description');
	// $this->registerMetaTag(['name' => 'tags', 'content' => call_user_func(function()use($model) {
	// $tags = '';
	// foreach ($model->articleTags as $tag) {
	// $tags .= $tag->value . ',';
	// }
	// return rtrim($tags, ',');
	// }
	// )], 'tags');
	// $this->registerMetaTag(['property' => 'article:author', 'content' => $model->author_name]);
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
	// $this->registerJsFile(Yii::$app->request->baseUrl . '/static/common/plugins/jquery.flexText.js', ['position' => \yii\web\View::POS_END, 'depends' => 'frontend\assets\PjaxAsset']);
	$avator = Yii::$app->request->baseUrl . '/static/template1/images/header-img-comment_03.png';
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
		<!--
		    此评论textarea文本框部分使用的https://github.com/alexdunphy/flexText此插件
		-->
		<div class="clearfix"></div>
		<div class="commentAll">
			<div class="comt-title" style="display: block;">
				<div class="comt-author left"><a class="switch-author" href="javascript:void(0)" data-type="switch-author" style="font-size:12px;">快让我登陆</a>
				</div>
				<a id="cancel-comment-reply-link" class="right" href="javascript:;" style="display: none;">取消评论</a>
				<div class="clearfix"></div>
			</div>
		    <!--评论区域 begin-->
		    <div class="reviewArea">
<!-- 		    	<div class="com-box">
			        <div class=" comment-content">
			        	<textarea class=" comment-input" placeholder="留下你的名言&hellip;"></textarea>
			        </div>
			        <div class="comment-ctrol">
			        	<button type="button" class="plBtn">评论</button>
						<div class="comt-tips right">
							<div class="comt-tip comt-error" style="display: none;"></div>
							<div class="comt-tip comt-loading" style="display: none;">正在提交, 请稍候...</div><div class="comt-tip comt-error" style="display: none;">#</div>
							</div>
						<span data-type="comment-insert-smilie" class="muted comt-smilie"><i class="fa fa-smile-o"></i> 表情</span>
			        </div>
		    	</div> -->
		    	<div class="comment" style="width: 100%; height: auto;">
					<div class="head-face" style="width: 10%; height: 120px; float: left;text-align: center;">
						<img src="<?=$avator?>" style="width: 50px;height: 50px;border-radius: 50%;">
						<p>游客</p>
					</div>
					<div class="content" style="width: 90%;height: 120px;float: right;">
						<div class="cont-box" style="width: 100%;height: 80px;border: 1px solid #99cc66;border-top-left-radius: 5px; border-top-right-radius: 5px;float: left;">
							<textarea class="text" placeholder="请输入..." style="width: 96.6%; height: 86.9%;border-radius: 5px;padding: 5px 10px;color: #999;font-family: '微软雅黑';font-size: 12px; resize: none;border: none; outline: none;float: left;"></textarea>
						</div>
						<div class="tools-box" style="width: 100%;height: 30px;border: 1px solid #99cc66;margin-top: 5px;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;float: left;">
							<div class="operator-box-btn" style="width: 85%;height: 30px;float: left;"><span class="face-icon" style="display: block;float: left;margin-top: -1px;margin-left: 10px;font-family: '微软雅黑';font-size: 22px;color: #99cc66;cursor: pointer;">☺</span><span class="img-icon" style="display: block; float: left;margin-top: -11px;margin-left: 10px;font-family: '微软雅黑'; font-size: 33px; font-weight: lighter;color: #99cc66;cursor: pointer;">▧</span></div>
							<div class="submit-btn" style="width: 15%;height: 30px; float: right;"><input type="button" onclick="out('.text', '#info-show ul')" value="提交评论" style="width: 100%; height: 100%;font-family: '微软雅黑';font-size: 14px;color: #fff;cursor: pointer;border: none;outline: none;background-color: #99cc66;"></div>
						</div>
					</div>
				</div>
		    	<div class="clearfix"></div>
		    </div>
		    <!--评论区域 end-->
		    <!--回复区域 begin-->
		    <div id="info-show" style=" width: 100%; margin-top: 20px;">
		    	<ul></ul>
		    	<div class="clearfix"></div>
		    </div>
<!-- 		    <div class="comment-show">
		        <div class="comment-show-con">
		            <div class="comment-show-con-img left"><img src="<?= $avator ?>" alt=""></div>
		            <div class="comment-show-con-list left ">
		                <div class="pl-text clearfix">
		                    <a href="#" class="comment-size-name">张三 : </a>
		                    <span class="my-pl-con">&nbsp;来啊 造作啊!</span>
		                </div>
		                <div class="date-dz">
		                    <span class="date-dz-left left comment-time">2017-5-2 11:11:39</span>
		                    <div class="date-dz-right right comment-pl-block">
		                        <a href="javascript:;" class="removeBlock">删除</a>
		                        <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block left">回复</a>
		                        <span class="left date-dz-line">|</span>
		                        <a href="javascript:;" class="date-dz-z left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a>
		                    </div>
		                </div>
		                <div class="hf-list-con"></div>
		            </div>
		        </div>
		    </div> -->
		    <!--回复区域 end-->
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
	    function keyUP(t) {
	        var len = $(t).val().length;
	        if(len > 139){
	            $(t).val($(t).val().substring(0,140));
	        }
	    }
		$(document).ready(function() {
			$("#scan_count").show()
			 $('.comment-content').flexText()
			$.ajax({
				url: "$ajaxurl",
				data: {id: $model->id},
				success: function(res) {
					$("#scan_count").text(res.scan_count)
				}
			})
		})

		// 绑定表情
		$('.face-icon').SinaEmotion($('.text'));
		// $(".comment-input").on('keyup', function() {
		// 	keyUP(this)
		// })
		// //点击评论创建评论条
	 //    $('.commentAll').on('click','.plBtn',function(){
	 //        var myDate = new Date();
	 //        //获取当前年
	 //        var year=myDate.getFullYear();
	 //        //获取当前月
	 //        var month=myDate.getMonth()+1;
	 //        //获取当前日
	 //        var date=myDate.getDate();
	 //        var h=myDate.getHours();       //获取当前小时数(0-23)
	 //        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
	 //        if(m<10) m = '0' + m;
	 //        var s=myDate.getSeconds();
	 //        if(s<10) s = '0' + s;
	 //        var now=year+'-'+month+"-"+date+" "+h+':'+m+":"+s;
	 //        //获取输入内容 $(this).siblings('.flex-text-wrap').find('.comment-input').val();
	 //        var oSize = $(this).parent('.comment-ctrol').siblings('.flex-text-wrap').find('.comment-input').val();
	 //        //动态创建评论模块
	 //        oHtml = '<div class="comment-show-con "><div class="comment-show-con-img left"><img src="{$avator}" alt=""></div> <div class="comment-show-con-list left "><div class="pl-text "> <a href="#" class="comment-size-name">David Beckham : </a> <span class="my-pl-con">&nbsp;'+ oSize +'</span> </div> <div class="date-dz"> <span class="date-dz-left left comment-time">'+now+'</span> <div class="date-dz-right right comment-pl-block"><a href="javascript:;" class="removeBlock">删除</a> <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block left">回复</a> <span class="left date-dz-line">|</span> <a href="javascript:;" class="date-dz-z left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a> </div> </div><div class="hf-list-con"></div></div> <div class="clearfix"></div></div>';
	 //        if(oSize.replace(/(^\s*)|(\s*$)/g, "") != ''){
	 //            $(this).parents('.reviewArea ').siblings('.comment-show').prepend(oHtml);
	 //            $(this).parent('.comment-ctrol').siblings('.flex-text-wrap').find('.comment-input').prop('value','').siblings('pre').find('span').text('');
	 //        }
	 //    });
	 //    //点击回复动态创建回复块
	 //    $('.comment-show').on('click','.pl-hf',function(){
	 //        //获取回复人的名字
	 //        var fhName = $(this).parents('.date-dz-right').parents('.date-dz').siblings('.pl-text').find('.comment-size-name').html();
	 //        //回复@
	 //        var fhN = '回复@'+fhName;
	 //        //var oInput = $(this).parents('.date-dz-right').parents('.date-dz').siblings('.hf-con');
	 //        var fhHtml = '<div class="hf-con left"> <textarea class="content comment-input hf-input" placeholder=""></textarea> <a href="javascript:;" class="hf-pl">评论</a></div>';
	 //        //显示回复
	 //        if($(this).is('.hf-con-block')){
	 //            $(this).parents('.date-dz-right').parents('.date-dz').append(fhHtml);
		// 		$(".comment-input").on('keyup', function() {
		// 			keyUP(this)
		// 		})
	 //            $(this).removeClass('hf-con-block');
	 //            $('.content').flexText();
	 //            $(this).parents('.date-dz-right').siblings('.hf-con').find('.pre').css('padding','6px 15px');
	 //            //console.log($(this).parents('.date-dz-right').siblings('.hf-con').find('.pre'))
	 //            //input框自动聚焦
	 //            $(this).parents('.date-dz-right').siblings('.hf-con').find('.hf-input').val('').focus().val(fhN);
	 //        }else {
	 //            $(this).addClass('hf-con-block');
	 //            $(this).parents('.date-dz-right').siblings('.hf-con').remove();
	 //        }
	 //    });
	 //    //评论回复块创建
	 //    $('.comment-show').on('click','.hf-pl',function(){
	 //        var oThis = $(this);
	 //        var myDate = new Date();
	 //        //获取当前年
	 //        var year=myDate.getFullYear();
	 //        //获取当前月
	 //        var month=myDate.getMonth()+1;
	 //        //获取当前日
	 //        var date=myDate.getDate();
	 //        var h=myDate.getHours();       //获取当前小时数(0-23)
	 //        var m=myDate.getMinutes();     //获取当前分钟数(0-59)
	 //        if(m<10) m = '0' + m;
	 //        var s=myDate.getSeconds();
	 //        if(s<10) s = '0' + s;
	 //        var now=year+'-'+month+"-"+date+" "+h+':'+m+":"+s;
	 //        //获取输入内容
	 //        var oHfVal = $(this).siblings('.flex-text-wrap').find('.hf-input').val();
	 //        console.log(oHfVal)
	 //        var oHfName = $(this).parents('.hf-con').parents('.date-dz').siblings('.pl-text').find('.comment-size-name').html();
	 //        var oAllVal = '回复@'+oHfName;
	 //        if(oHfVal.replace(/^ +| +$/g,'') == '' || oHfVal == oAllVal){

	 //        } else {
  //               //var oHtml = '<div class="all-pl-con"><div class="pl-text hfpl-text clearfix"><a href="#" class="comment-size-name">我的名字 : </a><span class="my-pl-con">'+oAt+'</span></div><div class="date-dz"> <span class="date-dz-left left comment-time">'+now+'</span> <div class="date-dz-right right comment-pl-block"> <a href="javascript:;" class="removeBlock">删除</a> <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block left">回复</a> <span class="left date-dz-line">|</span> <a href="javascript:;" class="date-dz-z left"><i class="date-dz-z-click-red"></i>赞 (<i class="z-num">666</i>)</a> </div> </div></div>';
	 //        }
	 //    });
	 //    //删除评论块
	 //    $('.commentAll').on('click','.removeBlock',function(){
	 //        var oT = $(this).parents('.date-dz-right').parents('.date-dz').parents('.all-pl-con');
	 //        if(oT.siblings('.all-pl-con').length >= 1){
	 //            oT.remove();
	 //        }else {
	 //            $(this).parents('.date-dz-right').parents('.date-dz').parents('.all-pl-con').parents('.hf-list-con').css('display','none')
	 //            oT.remove();
	 //        }
	 //        $(this).parents('.date-dz-right').parents('.date-dz').parents('.comment-show-con-list').parents('.comment-show-con').remove();
	 //    })
	 //    //点赞
	 //    $('.comment-show').on('click','.date-dz-z',function(){
	 //        var zNum = $(this).find('.z-num').html();
	 //        if($(this).is('.date-dz-z-click')){
	 //            zNum--;
	 //            $(this).removeClass('date-dz-z-click red');
	 //            $(this).find('.z-num').html(zNum);
	 //            $(this).find('.date-dz-z-click-red').removeClass('red');
	 //        }else {
	 //            zNum++;
	 //            $(this).addClass('date-dz-z-click');
	 //            $(this).find('.z-num').html(zNum);
	 //            $(this).find('.date-dz-z-click-red').addClass('red');
	 //        }
	 //    })

JS
);
?>