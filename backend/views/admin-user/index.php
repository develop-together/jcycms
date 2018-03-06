<?php

use yii\helpers\Html;
use backend\grid\GridView;
use backend\models\User;
use backend\models\AdminRoles;
use backend\grid\ActionColumn;
use yii\helpers\Url;

$this->title = 'Admin';
$assignment = function ($url, $model) {
    return @$model->userRole->role_id != AdminRoles::SUPER_ROLE_ID  ? Html::a('<i class="fa fa-tablet"></i> ' . yii::t('app', 'Assign Roles'), 'javacript:;', [
        'title' => 'assignment',
        'class' => 'btn btn-white btn-sm',
        'onclick' => 'assignRole(this)',
        'data-url' => $url,
        'data-id' => $model['id'],
    ]) : '';
};

?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-index-title') ?>
            <div class="ibox-content">
                <div class="mail-tools tooltip-demo m-t-md" style="padding-bottom: 10px;">
                    <?= $this->render('_search', ['model' => $searchModel])?>
                </div>
                <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'class' => '\yii\grid\CheckboxColumn',
                            ],
                            [
                                'attribute' => 'avatar',
                                'format' => 'raw',
                                'value' => function($model) {
                                    return Html::img($model->getAvatarFormat(), ['width' => '100' , 'height' => '100']);
                                },
                                'options' => ['width' => '100' , 'height' => '100'],
                                'filter' => '',
                                'enableSorting' => false,
                            ],                            
                            [
                                'attribute' => 'username',
                                'filter' => '',
                            ],
                            [
                                'attribute' => 'email',
                                'format' => 'email',
                                'filter' => '',
                            ],
                            [
                                    'attribute' => 'status',
                                    'filter' => '',//User::loadStatusOptions()
                                    'value' => function ($model) {
                                        return $model->statusFormat;
                                    },
                                    'enableSorting' => true,
                            ],
                            [
                                    'attribute' => 'created_at',
                                    'format' => 'datetime',
                                    'filter' => '',
                            ],

                            [
                                'class' => ActionColumn::className(),
                                'template' => '{assignment}{view}{update}{delete}',
                                'buttons' => ['assignment' => $assignment],
                            ],
                        ],
                    ]); ?>         
            </div>            
        </div>
    </div>
</div>
<script type="text/javascript">
    function assignRole(obj)
    {
        var id = $(obj).data('id') ? $(obj).data('id') : $(obj).attr('data-id');
        var url = $(obj).data('url') ? $(obj).data('url') : $(obj).attr('data-url');
        layer.open({
          type: 2,
          title: '角色分配',
          shadeClose: true,
          shade: 0.8,
          area: ['600px', '90%'],
          maxmin:true,
          content: url //iframe的url
        });         
    }

</script>
