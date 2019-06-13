<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	use frontend\widgets\ArticleListView;
	use frontend\models\Article;
	use yii\data\ArrayDataProvider;
	use frontend\models\Comment;
	use yii\caching\FileDependency;
	use yii\caching\DbDependency;

	$this->title = $model->title;
	$this->registerMetaTag(['name' => 'keywords', 'content' => $model->seo_keywords], 'keywords');
	$this->registerMetaTag(['name' => 'description', 'content' => $model->seo_description], 'description');
	$this->registerMetaTag(['name' => 'tags', 'content' => call_user_func(function()use($model) {
	$tags = '';
	foreach ($model->articleMetas as $tag) {
		$tags .= $tag->value . ',';
	}

	return rtrim($tags, ',');
	}
	)], 'tags');
	$this->registerMetaTag(['property' => 'article:author', 'content' => $model->author_name]);
	$this->params['breadcrumbs'] = [
	    [
	      'label' => Yii::t('frontend', 'Home'),
	      'url' => '/',
	      'class' => 'n1'
	    ],
	    [
	      'label' => $model->category->name,
	      'url' => '/article/index/' . $model->category->name,
	      'class' => 'n1'
	    ],
	    ['label' => $this->title],
	  ];
	$avator = Yii::$app->request->baseUrl . '/static/template1/images/header-img-comment_03.png';
	$ajaxurl = Url::to(['article/view-ajax']);
	$commentUrl = Url::to(['article/comment-ajax']);
	$addLikeUrl = Url::to(['article/add-like']);
	$uCenterUrl = Url::to(['user/center']);
	$i18n1 = Yii::t('frontend', 'Please enter the picture address here');
	$i18n2 = Yii::t('frontend', 'Submiting...');
	$i18n3 = Yii::t('frontend', 'Cannot submit empty comments');
	$i18n4 = Yii::t('frontend', 'Submit comments');
	$i18n5 = Yii::t('frontend', 'Please input...');
	$i18n6 = Yii::t('frontend', 'reply');
	$i18n7 = Yii::t('frontend', 'praise');
	$i18n8 = Yii::t('frontend', 'forwarding');
    $comments = Comment::chilrdenDatas($model->comments, 0);
    // var_dump($comments);exit;
    // DB依赖（数据库依赖）【依赖的为数据库查询条数，一但文章被修改，缓存失效】
    $dependency = new DbDependency([
    	'sql' => 'SELECT updated_at FROM ' . Article::tableName() . ' WHERE `id` = ' . $model->id . ' LIMIT 1'
    ]);
?>

<!--
    片段缓存通过beginCache来实现，如果需要设置缓存时间的话需要在beginCache里面添加第二个参数，是个数组
    ['duration'=>20]
-->
<article class="blogs" >
	<?= $this->render('/widgets/_navigation') ?>
 	<div class="index_about">
 		<?php if ($this->beginCache('cache_div_' . $model->id, ['duration' => 3600 * 24, 'dependency' => $dependency, 'enabled' => true])): ?>
		<div id="cache_div_<?= $model->id ?>">
			<h2 class="c_titile"><?= $model->title ?></h2>
			<p class="box_c">
				<span class="d_time"><?= Yii::t('frontend', 'Created At') ?>：<?= $this->renderDynamic("\"return \"$model->created_at\";") ?></span>
				<span><?= Yii::t('frontend', 'Author') ?>：<?= $model->user->penname ?></span>
				<span><?= Yii::t('frontend', 'View count')?>：<b id="scan_count" style="display: none"><?= $this->renderDynamic("\"return \"$model->getScan_count()\";") ?></b></span>
			</p>
			<div class="infos">
				<?= $model->content ?>
			</div>
		    <div class="keybq">
		    	<p><span><?= Yii::t('frontend', 'Keywords') ?></span>：
					<?php if ($model->tagFormat): ?>
                        <?php foreach ($model->tagFormat as $tag): ?>
                            <a href="<?= Url::to(['article/tags', 'tag' => $tag]) ?>" target="_self"><?= $tag ?></a>
                        <?php endforeach ?>
					<?php endif ?>
		    	</p>
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
			            'allModels' => Article::find()->article()->where(['category_id' => $model->category_id])->limit(6)->all(),
			         ]),
			        'layout' => '<h2>' . Yii::t('frontend', 'About Articles') . '</h2><ul>{items}</ul>',
			        'template' => '<a href="{viewUrl}" title="{title}">{title}</a>',
			        'itemOptions' => ['tag'=>'li'],
			    ]) ?>
			</div>
		</div>
		<?php $this->endCache(); ?>
		<?php endif ?>
		<!--
		    此评论textarea文本框部分使用的https://github.com/alexdunphy/flexText此插件
		-->
		<div class="clearfix"></div>
		<?php if (intval(Yii::$app->jcore->open_comment) === 1 && $model->can_comment === 1): ?>
			<div class="commentAll">
				<div class="comt-title" style="display: block;">
					<div class="comt-author left">
						<?php if (Yii::$app->user->isGuest): ?>
							<a class="switch-author" href="javascript:void(0)" style="font-size:12px;"><?= Yii::t('frontend', 'Get me logged in') ?></a>
						<?php else: ?>
							<a class="author"  style="font-size:12px;" href="<?= $uCenterUrl ?>">Hi, <?= Yii::$app->getUser()->identity->username ?></a>
						<?php endif ?>
					</div>
					<a id="cancel-comment-reply-link" class="right" href="javascript:;" style="display: none;"><?= Yii::t('frontend', 'Cancel comment') ?></a>
					<div class="clearfix"></div>
				</div>
			    <!--评论区域 begin-->
			    <div class="reviewArea">
			    	<div class="comment" >
						<div class="head-face">
							<img src="<?=$avator?>" >
							<!-- <p><?php //echo Yii::t('frontend', 'Guest') ?></p> -->
						</div>
						<div class="comment_content">
							<div class="cont-box">
								<textarea class="comment-input text" id="comment-textarea" placeholder="<?= $i18n5 ?>"></textarea>
							</div>
							<div class="tools-box" >
								<div class="operator-box-btn">
									<span class="face-icon">☺</span>
									<span class="img-icon" >▧</span>
									<span class="colse-icon">x</span>
								</div>
								<div class="comt-loading" style="display: none">
									<span><?= $i18n2 ?></span>
								</div>
								<div class="submit-btn">
									<button type="button" class="submit-comment-btn"><?= $i18n4 ?></button>
								</div>
							</div>
						</div>
					</div>
			    	<div class="clearfix"></div>
			    </div>
			    <!--评论区域 end-->
			    <!--回复区域 begin-->
			    <div id="comment-show-0" class="info-show">
			    	<ul>
				    	<?php if ($comments): ?>
				    		<?php foreach ($comments as $comment): ?>
									<li>
										<div class="head-face">
											<img src="<?= $comment->getAvator() ?>">
										</div>
										<div class="reply-cont">
											<p class="username"><?= $comment->nickname ?></p>
											<p class="comment-body"><?= $comment->contents ?></p>
											<p class="comment-footer">
												<div style="float:left;padding-right: 5px;"><?= $comment->created_at ?></div>
												<div style="float:left;padding-right: 5px;cursor: pointer;" class="comment-hf hf-con-block" data-aid="<?= $comment->article_id ?>" data-id="<?= $comment->id ?>" data-addcommented="0"><?= $i18n6 ?></div>　
												<div style="float:left;padding-right: 5px;" class="date-dz-z" data-submited="0" data-id="<?= $comment->id ?>"><i class="date-dz-z-click-red"></i><?= $i18n7 ?> (<i class="z-num"><?= $comment->like_count ?></i>)</div>
												<div style="float:left;"><?= $i18n8 ?> <?= $comment->repeat_count ?></div>
											</p>
										</div>
										<?php if ($comment->childrens): ?>
											<div class="info-show" style="width:80%;margin-left: 50px;margin-top: 0px;">
												<ul>
													<?php foreach ($comment->childrens as $value): ?>
														<li style="border:none">
															<div class="head-face">
																<img src="<?= $value->getAvator() ?>">
															</div>
															<div class="reply-cont">
																<p class="username"><?= $value->nickname ?></p>
																<p class="comment-body"><?= $value->contents ?></p>
																<p class="comment-footer">
																	<div style="float:left;padding-right: 5px;"><?= $value->created_at ?></div>
																	<div style="float:left;padding-right: 5px;cursor: pointer;" class="comment-hf hf-con-block" data-aid="<?= $value->article_id ?>" data-id="<?= $value->id ?>" data-addcommented="0"><?= $i18n6 ?></div>　
																	<div style="float:left;padding-right: 5px;" class="date-dz-z" data-id="<?= $value->id ?>" data-submited="0"><i class="date-dz-z-click-red"></i><?= $i18n7 ?> (<i class="z-num"><?= $value->like_count ?></i>)</div>
																	<div style="float:left;"><?= $i18n8 ?> <?= $value->repeat_count ?></div>
																</p>
															</div>
														</li>
													<?php endforeach ?>
													<!-- <li class='clearfix'></li> -->
												</ul>
												<div class="clearfix"></div>
											</div>
											<div class="clearfix"></div>
										<?php endif ?>
										</li>
				    		<?php endforeach ?>
				    	<?php endif ?>
			    	</ul>
			    	<div class="clearfix"></div>
			    </div>
			</div>
		<?php endif ?>
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
	            'allModels' => Article::find()->article()->limit(8)->orderBy(['created_at' => SORT_DESC])->all(),
	         ]),
	        'layout' => '<h3><p>' . Yii::t('frontend', 'Newest') . '<span>' . Yii::t('frontend', 'Article') . '</span></p></h3><ul class="rank">{items}</ul>',
	        'template' => '<a href="{viewUrl}" title="{title}">{title}</a>',
	        'itemOptions' => ['tag'=>'li'],
	    ]) ?>
	    <?= ArticleListView::widget([
	        'dataProvider' => new ArrayDataProvider([
	            'allModels' => Article::find()->article()->limit(6)->orderBy(['scan_count' => SORT_DESC])->all(),
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
	$this->registerJs(<<<JS
	    function keyUP(t) {
	        var len = $(t).val().length;
	        if(len > 139){
	            $(t).val($(t).val().substring(0,140));
	        }
	    }
	    function submitComment() {
			var isComment = false;//one
			$("div.comment_content").on('click', '.submit-comment-btn', function() {
				if (isComment) {
					return false;
				}
				isComment = true
				$(this).attr('disabled', true)
				$(this).attr('readonly', true)
				// this.removeEventListener('click', function(){alert(222)}, false);
				var self = this;
				var textareaObj = $(this).parent('.submit-btn').parent('.tools-box').siblings('.cont-box').children('textarea.comment-input');
				var content = textareaObj.val();
				// debugger;
				var pid = textareaObj.attr('data-pid') ? parseInt(textareaObj.attr('data-pid')) : 0;
				$(this).parent('.submit-btn').siblings(".comt-loading").show();
				if (!content) {
					$(this).parent('.submit-btn').siblings(".comt-loading").html("<span style='color:red'>$i18n3</span>");
				}
				// var csrfParam = $("meta[name='csrf-param']").attr('content');
				var csrfToken = $("meta[name='csrf-token']").attr('content');
				$(this).parent('.tools-box').siblings(".comt-loading").show();
				$.ajax({
					url: "$commentUrl",
					type: 'POST',
					dataType: 'JSON',
					cache:false,
					data: {article_id: $model->id, parent_id: pid, contents: content, _csrf_frontend: csrfToken},
					success: function(res) {
						if ( 10002 === res.code ) {
							commentOut("#comment-show-" + pid + " > ul", res.data, ['$i18n6', '$i18n7', '$i18n8'])
							$(self).parent('.submit-btn').siblings(".comt-loading").hide();
							textareaObj.val('');

						} else if (10003 == res.code ) {
							layer.msg(res.message, {icon:5});
							setTimeout(function() {
								location.reload();
							}, 700);
						} else {
							alert(res.message);
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
	                     console.log(jqXHR.responseJSON.message);
	                }
				})
			})
	    }
		$(document).ready(function() {
	        // 绑定表情
			$('.face-icon').SinaEmotion($('.text'));
			$("#scan_count").show();
			//绑定删除评论框
			$(".tools-box").on('click', '.colse-icon', function() {
				$(this).parent('div.operator-box-btn').parent('div.tools-box').parent('div.comment_content').parent('div.comment').hide();
			});
			 // $('.comment-content').flexText()
			// setTimeout(function() {
			// 	$(".info-show > ul > li").each(function() {
			// 		$(this).find('.comment-body').html(AnalyticEmotion($(this).find('.comment-body').html()));
			// 		$(this).find(".info-show > ul > li").each(function() {
			// 			$(this).find('.comment-body').html(AnalyticEmotion($(this).find('.comment-body').html()));
			// 		})
			// 	});
			// }, 500);
			//快让我登陆
			$(".switch-author").bind('click', function () {
				$("#loginModal").show();
				$(".modal-backdrop").addClass('in');
				$(".modal-backdrop").show();
			})
			//close loginModal
			$("#login_close").on('click', function() {
				$("#loginModal").hide();
				$(".modal-backdrop").removeClass('in');
				$(".modal-backdrop").hide();
			})
	        //点击回复动态创建回复块
	        $('.info-show').on('click','.comment-hf',function() {
	        		if (parseInt($(this).attr('data-addcommented')) === 1) {//或者一开始清空下
	        			return false;
	        		}

					//获取回复人的名字
					var fhName = $(this).siblings('.username').html();
					var id = $(this).data('id');
					//回复@
					var fhN = '回复@' + fhName;
					var fhHtml = '<div class="comment_content" style="display:block;float:none"><div class="cont-box hf-con"><textarea class="comment-input hf-input" placeholder="" data-pid=" ' + id + '" id="comment-input-' + id + '"></textarea></div><div class="tools-box"><div class="operator-box-btn"><span class="face-icon">☺</span><span class="img-icon">▧</span><span class="colse-icon" data-id="' + id + '">x</span></div><div class="comt-loading" style="display: none"><span>$i18n2</span></div><div class="submit-btn"><button type="button" class="submit-comment-btn">$i18n4</button></div></div></div><div id="comment-show-' + id + '" class="info-show"><ul></ul></div>';
					//显示回复
					if ($(this).is('.hf-con-block')) {
						$(this).parents('.reply-cont').append(fhHtml);
						$('.face-icon').SinaEmotion($('#comment-input-' + id));
						$(".img-icon").click(function(){
							$(".cont-box #comment-input-" + id).insertContent('<img src="$i18n1" alt=""/>', -10);
						});
						$(".tools-box").on('click', '.colse-icon', function() {
							$(this).parent('div.operator-box-btn').parent('div.tools-box').parent('div.comment_content').hide();
							var id = $(this).data('id');
							if (id) {
								$('.comment-hf[data-id="' + id + '"]').attr('data-addcommented', 0);
								$('.comment-hf[data-id="' + id + '"]').addClass('hf-con-block');
							}
						});
						$(".hf-input").on('keyup', function() {
						 	keyUP(this)
						})
						submitComment();
						$(this).removeClass('hf-con-block');
						// $('.content').flexText();
						$(this).siblings('.hf-con').find('.hf-input').val('').focus().attr('placeholder', fhN);
		            } else {
		                $(this).addClass('hf-con-block');
		                $(this).remove();
		            }
		            $(this).attr('data-addcommented', 1);
	        });
			//点赞
	        $('.info-show').on('click','.date-dz-z',function(){
        		// if (parseInt($(this).data('submited')) === 1) {//或者一开始清空下
        		// 	return false;
        		// }
				var self = this;
	            var zNum = $(this).find('.z-num').html();
        		var id = $(this).data('id');
        		var csrfToken = $("meta[name='csrf-token']").attr('content');
        		var type = 1;
	            if($(this).is('.date-dz-z-click')){
	                zNum--;
	                $(this).removeClass('date-dz-z-click red');
	                $(this).find('.z-num').html(zNum);
	                $(this).find('.date-dz-z-click-red').removeClass('red');
	            }else {
	            	zNum++;
	            	type = 2;
	            }
            	$.ajax({
					type: 'POST',
					url: '$addLikeUrl',
					data: {id: id, _csrf_frontend: csrfToken, num: zNum},
					success: function (data) {
						if (parseInt(data) === 1) {
			                $(self).find('.z-num').html(zNum);
							if (type === 1) {
								$(self).removeClass('date-dz-z-click red');
								$(self).find('.date-dz-z-click-red').removeClass('red');
							} else {
				                $(self).addClass('date-dz-z-click');
				                $(self).find('.date-dz-z-click-red').addClass('red');
							}
			                // $(self).attr('data-submited', 1);
						}
					}
            	})
	        })
			// $.ajax({
			// 	url: "$ajaxurl",
			// 	data: {id: $model->id},
			// 	success: function(res) {
			// 		$("#scan_count").text(res.scan_count)
			// 		if (res.nickname) {
			// 			$(".comt-author").html('<a class="author" target="_self" style="font-size:12px;" href="{$uCenterUrl}">Hi, ' + res.nickname + '</a>');
			// 		}
			// 	}
			// })
	        $("#comment-textarea").bind('keyup', function() {
				return checkCommentkeyUP(this)
	        })
		})
		submitComment();
JS
);
?>