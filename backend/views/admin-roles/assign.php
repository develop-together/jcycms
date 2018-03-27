<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\ZtreeAsset;

ZtreeAsset::register($this);
$this->title = Yii::t('app', 'Assign Permission');
?>

 <div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content"> 
            	<div class="row text-center"><strong><?= $model->role_name ?></strong></div>   
				<div class="form-group">
					<ul id="menu_tree_<?= Yii::$app->controller->_uniqid ?>" class="ztree"></ul>
				</div>     
				<div class="clearfix"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2  text-right">
                        <?= Html::Button(Yii::t('app', 'Assign Permission'), ['class' => 'btn btn-success']) ?>
                        
                        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>                        
                    </div>
                </div>   
            </div>      
        </div>
    </div>
</div>
<?php 
$url = Url::toRoute(['admin-roles/ajax-menu-nodes']);
$uniqid = Yii::$app->controller->_uniqid;
$this->registerJs(<<<EOTM
		var setting = {
			check: {
				enable: true
			},
			async: {
				enable: true,
				url:"$url",
				autoParam:["id", "nam", "level"],
				otherParam:{"_csrf_backend": $("meta[name='csrf-token']").attr('content')},
				dataFilter: filter
			},
			callback: {
				onAsyncError: onAsyncError,
				onAsyncSuccess: onAsyncSuccess
			}
		};

		var log;

		function onAsyncError(event, treeId, treeNode, XMLHttpRequest, textStatus, errorThrown) 
		{
			showLog("[ "+getTime()+" onAsyncError ]&nbsp;&nbsp;&nbsp;&nbsp;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
		}

		function onAsyncSuccess(event, treeId, treeNode, msg) 
		{
			showLog("[ "+getTime()+" onAsyncSuccess ]&nbsp;&nbsp;&nbsp;&nbsp;" + ((!!treeNode && !!treeNode.name) ? treeNode.name : "root") );
		}
		
		function showLog(str) 
		{
			console.log('日志信息：', str);
		}

		function getTime() {
			var now= new Date(),
			h=now.getHours(),
			m=now.getMinutes(),
			s=now.getSeconds(),
			ms=now.getMilliseconds();
			return (h+":"+m+":"+s+ " " +ms);
		}

		function filter(treeId, parentNode, childNodes) {
			if (!childNodes) return null;
			for (var i=0, l=childNodes.length; i<l; i++) {
				childNodes[i].name = childNodes[i].name.replace(/\.n/g, '.');
			}
			return childNodes;
		}

		$.fn.zTree.init($("#menu_tree_$uniqid"), setting);

EOTM
)
 ?>