<?php
	use yii\helpers\Html;
	use yii\helpers\Url;
	$this->registerJsFile(Yii::$app->request->baseUrl . '/static/js/plugins/echarts/echarts.min.js', [
		'position' => \yii\web\View::POS_END]);
	$uniqid = Yii::$app->controller->_uniqid;
    $chartTitle = Yii::t('app', 'New Quantity Statistical Chart');
 ?>
 <div class="row">
 	<?php if ($countData): ?>
 		<?php foreach ($countData as $key => $data): ?>
		    <div class="col-sm-3">
		        <div class="ibox float-e-margins">
		            <div class="ibox-title">
		                <span class="label label-primary pull-right"><?= Yii::t('app', $data['type']) ?></span>
		                <h5><?= $data['countName'] ?></h5>
		            </div>
		            <div class="ibox-content <?= ($data['url'] != 'javascript:;' || empty($data['url'])) ? 'openContab' : '' ?>" href="<?= $data['url'] ?>" title="<?= $data['countName'] ?>" style="cursor: pointer">
		                <h1 class="no-margins"><?= $data['countNumber'] ?></h1>
		                <?php if($data['countName'] == Yii::t('app', 'Articles')): ?>
			                <div class="stat-percent font-bold text-success"><?= $data['proportion'] ?>% <i class="fa fa-bolt"></i>
			                </div>
			            <?php else: ?>
			                <div class="stat-percent font-bold text-info"><?= $data['proportion'] ?>% <i class="fa fa-level-up"></i>
			                </div>
		            	<?php endif; ?>
		                <small><?= Yii::t('app', 'Total') ?></small>
		            </div>
		        </div>
		    </div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
<!-- Echarts 统计图 start -->
<div class="row">
	<div class="col-sm-12">
        <div class="ibox-title">
            <h5><?= $chartTitle ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link ui-sortable">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
        	<div  id="countMap_<?= $uniqid ?>" style="height: 250px;"></div>
        </div>
	</div>
</div>
<!-- Echarts 统计图 end -->
<div class="row">
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= Yii::t('app', 'Click on the general list') ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">
                <?php if ($readRanking): ?>
                    <ul class="list-group">
                    <?php foreach ($readRanking as $key => $read): ?>
                        <li class="list-group-item">
                            <?php
                                if (0 === $key && $read->scan_count > 0) {
                                    echo  Html::a($read->title, Url::to(['article/view', 'id' => $read->id]), ['title' => $read->sub_title]) . '<small class="pull-right text-danger"><i class="fa fa-thumbs-up"></i></small> <span class="pull-right badge badge-info">' . $read->scan_count . '</span> ';
                                } else {
                                    echo Html::a($read->title, Url::to(['article/view', 'id' => $read->id]), ['title' => $read->sub_title]) . '<span class="pull-right badge badge-info">' . $read->scan_count . '</span>';
                                }
                            ?>
                        </li>
                    <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= Yii::t('app', "Comments on the general list") ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">
                <?php if ($commentRanking): ?>
                    <ul class="list-group">
                    <?php foreach ($commentRanking as $key => $cr): ?>
                        <li class="list-group-item">
                            <?php
                                if (0 === $key $read->comment_count > 0) {
                                    echo  Html::a($cr->title, Url::to(['article/view', 'id' => $cr->id]), ['title' => $cr->sub_title]) . '<small class="pull-right text-danger"><i class="fa fa-heart"></i></small> <span class="pull-right badge badge-info">' . $cr->comment_count . '</span> ';
                                } else {
                                    echo Html::a($cr->title, Url::to(['article/view', 'id' => $cr->id]), ['title' => $cr->sub_title]) . '<span class="pull-right badge badge-info">' . $cr->comment_count . '</span>';
                                }
                            ?>
                        </li>
                    <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= Yii::t('app', 'Environment') ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge badge-info">&nbsp;&nbsp;</span><strong>JCY
                            CMS</strong>: <?= yii::$app->version ?>
                    </li>
                    <li class="list-group-item ">
                        <span class="badge badge-info">&nbsp;&nbsp;</span> <strong>Web
                            Server</strong>: <?= $enviromentInfo['opreating_enviroment'] ?>
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">&nbsp;&nbsp;</span>
                        <strong><?= Yii::t('app', 'Database Info') ?></strong>: <?= $enviromentInfo['db_info'] ?>
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">&nbsp;&nbsp;</span>
                        <strong><?= Yii::t('app', 'File Upload Limit') ?></strong>: <?= $enviromentInfo['upload_max_filesize'] ?>
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-success">&nbsp;&nbsp;</span>
                        <strong><?= Yii::t('app', 'Script Time Limit') ?></strong>: <?= $enviromentInfo['max_execution_time'] ?>
                    </li>
                    <li class="list-group-item">
                        <span class="badge badge-danger">&nbsp;&nbsp;</span>
                        <strong><?= Yii::t('app', 'PHP Execute Method') ?></strong>: <?= $enviromentInfo['php_run_mode'] ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="ibox-title">
            <h5><?= Yii::t('app', 'Status') ?></h5>
            <div class="ibox-tools">
                <a class="collapse-link ui-sortable">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div>
                <div>
                    <span><?= Yii::t('app', 'Memory Usage') ?></span>
                    <small class="pull-right">
                        <?php if (PHP_OS == 'Linux') {
                            echo $serverStatics['mem']['num'];
                        } else {
                            echo Yii::t('app', 'Only supported linux system');
                        }
                        ?>
                    </small>
                </div>
                <div class="progress progress-small">
                    <div style="width: <?= $serverStatics['mem']['percentage'] ?>;" class="progress-bar"></div>
                </div>

                <div>
                    <span><?= Yii::t('app', 'Real Memory Usage') ?></span>
                    <small class="pull-right">
                        <?php if (PHP_OS == 'Linux') {
                            echo $serverStatics['real_mem']['num'];
                        } else {
                            echo Yii::t('app', 'Only supported linux system');
                        }
                        ?>
                    </small>
                </div>
                <div class="progress progress-small">
                    <div style="width: <?= $serverStatics['real_mem']['percentage'] ?>;" class="progress-bar"></div>
                </div>
                <div>
                    <span><?= Yii::t('app', 'Disk Usage') ?></span>
                    <small class="pull-right"><?= $serverStatics['disk_space']['num'] ?></small>
                </div>
                <div class="progress progress-small">
                    <div style="width: <?= $serverStatics['disk_space']['percentage'] ?>%;" class="progress-bar progress-bar-danger"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5><?= Yii::t('app', 'Time Tips') ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content no-padding">
                <ul class="list-group">
                    <li class="list-group-item">
                       <strong>当前时间:</strong>
                       <span id="clock_<?= $uniqid ?>"></span>
                    </li>
                    <li class="list-group-item">
                        <strong>今天是星期<?= date('w') == 0 ? '天' : date('w') ?>(<?= date('l') ?>)</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>今天是本月的第<?= date('j') ?>天</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>今年已经过去<?= date('z')?> 天</strong>
                    </li>
                    <li class="list-group-item">
                        <strong>现在是今年的第<?= date('W')?> 周</strong>
                    </li>
                    <li class="list-group-item">
                        <strong><?= date('L') == 1 ? '今年是闰年' : '今年不是闰年' ?></strong>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .list-group-item > .badge {
        float: left
    }

    li.list-group-item strong {
        margin-left: 15px;
    }
</style>
<?php
	$this->registerJs(<<<EOT
		<!--当周新增数量统计图
		var myChart = echarts.init(document.getElementById('countMap_$uniqid'));
        var option = {
            title: {
                text: '$chartTitle',
            },
            tooltip : {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    label: {
                        backgroundColor: '#6a7985'
                    }
                }
            },
            legend: {
                data: {$echartsData['legends']}
            },
            toolbox: {
                show: true,
                feature: {
                    dataZoom: {
                        yAxisIndex: 'none'
                    },
                    dataView: {readOnly: false},
                    magicType: {type: ['line', 'bar']},
                    restore: {},
                    saveAsImage: {}
                }
            },
            grid: {
                left: '3%',
                right: '4%',
                bottom: '3%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    boundaryGap : false,
                    data : {$echartsData['xAxis']}
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : {$echartsData['series']}
        };
		myChart.setOption(option);
		//-->
        function displayTime(domId)
        {
            var obj = document.getElementById(domId);
            var nowDate = new Date();
            var year = nowDate.getFullYear();
            var month = nowDate.getMonth() + 1;
            var date = nowDate.getDate() ;
            obj.innerHTML = year + '-' + month + '-' + date + ' ' + nowDate.toLocaleTimeString();

        }
        setInterval(function() {
            displayTime("clock_$uniqid");
        }, 1000);
EOT
	);
?>