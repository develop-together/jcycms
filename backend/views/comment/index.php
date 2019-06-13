<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\grid\GridView;
use backend\models\Comment;
use backend\grid\ActionColumn;

$zh_cn = Yii::t('app', 'Verify');
?>

<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                    <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                        <?= (isset($searchModel)) ? $this->render('_search', ['model' => $searchModel]) : '' ?>
                    </div>
                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                             'columns' => [
                                    [
                                        'class' => 'yii\grid\CheckboxColumn'
                                    ],
                                    'id',
    								'nickname',
    								'ip',
    								[
                                        'attribute' => 'status',
                                        'format' => 'raw',
                                        'value' => function($model) {
                                            return $model->getStatusFormat();
                                        }
                                    ],
    								'like_count',
    								'repeat_count',
                                    'contents:raw',
    								'created_at',
                                [
                                    'class' => 'backend\grid\ActionColumn',
                                    'buttons' => [
                                        'audit' => function($url, $model, $key) use ($zh_cn) {
                                            if (Comment::STATUS_INIT !== $model->status || !Yii::$app->jcore->open_comment_verify) {
                                                return '';
                                            }

                                            return Html::a('<i class="fa fa-check" aria-hidden="true"></i> ' . $zh_cn, 'javascript:;', ['data-url' => Url::toRoute(['audit', 'id' => $model->id]), 'class' => 'btn  btn-danger btn-sm audit-btn', 'style' => 'margin:5px 0px;']);
                                        }
                                    ],
                                    'template' => '{view}{audit}{delete}',
                                ],
                            ]
                        ]); ?>
            </div>
        </div>
    </div>
</div>
<?php
    $btn_cn = Yii::t('app', 'Verify');
    $this->registerJs(<<<JS
            $("a.audit-btn").bind('click', function() {
                layer.open({
                    type: 2,
                    title: '{$zh_cn}',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['600px', '90%'],
                    maxmin:true,
                    content: $(this).data('url'),
                    btn: ['{$btn_cn}']
                    ,yes: function(index, layero){
                        var iframe = $(layero).find('iframe#layui-layer-iframe1');
                        var status = parseInt($(iframe).contents().find("input[name='Comment[status]']:checked").val());
                        var csrfToken = $(iframe).contents().find("input[name='_csrf_backend']").val();
                        var data = {Comment: {status: status}, _csrf_backend: csrfToken};
                        var action = $(iframe).contents().find("form[id*='comment-form-']").attr('action');
                        layer.load(2);
                        $.post(action, data, function(res) {
                            if ( 200 === res.code ) {
                                layer.msg(res.message, {icon: 6});
                            } else {
                                layer.msg(res.message, {icon: 5});
                            }
                            layer.closeAll('loading');
                            setTimeout(function() {
                                location.reload();
                            }, 300)
                        })

                    }
                    // ,btn2: function(index, layero){
                    // //按钮【按钮二】的回调

                    // //return false 开启该代码可禁止点击该按钮关闭
                    // }
                    // ,btn3: function(index, layero){
                    // //按钮【按钮三】的回调

                    // //return false 开启该代码可禁止点击该按钮关闭
                    // }
                    // ,cancel: function(){
                    // //右上角关闭回调

                    // //return false 开启该代码可禁止点击该按钮关闭
                    // }
                });
            })
JS
        );
 ?>


