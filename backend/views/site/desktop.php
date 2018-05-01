<?php 
	use yii\helpers\Html;
	use yii\helpers\Url;
	$this->registerJsFile(Yii::$app->request->baseUrl . '/static/js/plugins/echarts/echarts.min.js', [
		'position' => \yii\web\View::POS_END]);
	$uniqid = Yii::$app->controller->_uniqid;
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
		            <div class="ibox-content openContab" href="<?= $data['url'] ?>" title="<?= $data['countName'] ?>" style="cursor: pointer">
		                <h1 class="no-margins"><?= $data['countNumber'] ?></h1>
		                <?php if($data['countName'] == Yii::t('app', 'Articles')): ?>
			                <div class="stat-percent font-bold text-success"><?= $data['proportion'] ?>% <i class="fa fa-bolt"></i>
			                </div>
			            <?php else: ?>
			                <div class="stat-percent font-bold text-info"><?= $data['proportion'] ?>% <i class="fa fa-level-up"></i>
			                </div>
		            	<?php endif; ?>
		                <small><?= yii::t('app', 'Total') ?></small>
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
            <h5><?= Yii::t('app', 'Statistical Chart') ?></h5>
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
                    <style>
                        .list-group-item > .badge {
                            float: left
                        }

                        li.list-group-item strong {
                            margin-left: 15px;
                        }
                    </style>
                    <li class="list-group-item">
                        <span class="badge badge-primary">&nbsp;&nbsp;</span><strong>JCY
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
    <div class="col-sm-6">
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
                            echo yii::t('app', 'Only supported linux system');
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
                            echo yii::t('app', 'Only supported linux system');
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
</div>
<?php 
	$this->registerJs(<<<EOT
		<!--报名统计图
		var myChart = echarts.init(document.getElementById('countMap_$uniqid'));
		var option = {
		    xAxis: {
		        type: 'category',
		        boundaryGap: false,
		        data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
		    },
		    yAxis: {
		        type: 'value'
		    },
		    series: [{
		        data: [820, 932, 901, 934, 1290, 1330, 1320],
		        type: 'line',
		        areaStyle: {}
		    }]
		};
		myChart.setOption(option);
		//-->
EOT
	);
?>