<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\assets\ZtreeAsset;
use backend\models\AdminRoles;

ZtreeAsset::register($this);
$this->title = Yii::t('app', 'Assign Permission');
?>

 <div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content"> 
            	<div class="row text-center"><strong><?= $model->role_name ?></strong></div>
                <?php $form = ActiveForm::begin([
                            'fieldConfig' => [
                                'template' =>"{label}\n<div class=\"col-sm-10\">{input}\n{error}</div>\n{hint}",
                                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                                'options' => ['class' => 'form-group'],    
                                'inputOptions' => ['class' => 'form-control'],
                                'errorOptions' => ['class' => 'help-block m-b-none'],                            
                            ],
                            'options' => ['class' => 'form-horizontal']
                        ]);
                ?>  
				<div class="form-group">
					<ul id="menu_tree_<?= Yii::$app->controller->_uniqid ?>" class="ztree"></ul>
					<?= Html::hiddenInput('menuLists', null, ['id' => 'menu_lists_' . Yii::$app->controller->_uniqid]) ?>
				</div>     
				<div class="clearfix hr-line-dashed"></div>
				<?php if ($model->id != AdminRoles::SUPER_ROLE_ID): ?>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2  text-right">
                        <?= Html::SubmitButton(Yii::t('app', 'Assign Permission'), ['class' => 'btn btn-success']) ?>
                        
                        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']);?>                        
                    </div>
                </div>   
            	<?php endif; ?>
                <?php ActiveForm::end(); ?>  
            </div>      
        </div>
    </div>
</div>
<?php 
$url = Url::toRoute(['admin-roles/ajax-menu-nodes', 'id' => $model->id]);
$uniqid = Yii::$app->controller->_uniqid;
$this->registerJs(<<<EOTM
		var setting = {
			check: {
				enable: true,
				chkDisabledInherit: true,
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
				onAsyncSuccess: onAsyncSuccess,
				beforeClick: beforeClick,
				onCheck: myCheck,
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

		function beforeClick(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("menu_tree_$uniqid");
			zTree.checkNode(treeNode, !treeNode.checked, true, true);
			return false;
		}

/*		function myClick(event, treeId, treeNode, clickFlag)
		{
			var zTree = $.fn.zTree.getZTreeObj("menu_tree_$uniqid");
			zTree.checkNode(treeNode, !treeNode.checked, true); 
			return false;
		}*/

		function myCheck(event, treeId, treeNode)
		{
			var zTree = $.fn.zTree.getZTreeObj("menu_tree_$uniqid"),
			checkedValue = '',
			checkedNodes = zTree.getCheckedNodes(true);
			console.log(checkedNodes);
			for (var i = 0; i < checkedNodes.length; i++) {
				checkedValue += checkedNodes[i].id + ',';
			}
			
			checkedValue = checkedValue.substr(0, checkedValue.length-1);
			$("#menu_lists_$uniqid").val(checkedValue);

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