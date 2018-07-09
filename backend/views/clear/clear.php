<?php 
	$this->title = '清除缓存';
?>
<div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <div class="ibox-content">
                <?= Yii::t('app', 'Success') ?>
            </div>
        </div>
    </div>
</div>
<?php 
$this->registerJs(<<<EOT
	if (parent) {
		setTimeout(function(){
			 parent.close_tab(parent.$(".active.J_menuTab[data-id$='/clear/frontend']").eq(0));
			 parent.close_tab(parent.$(".active.J_menuTab[data-id$='/clear/backend']").eq(0));
		}, 3000)
	}
EOT
)
 ?>