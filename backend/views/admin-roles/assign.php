<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\AdminRoles;
use backend\models\AuthItem;

$this->title = $model->role_name . ':' . Yii::t('app', 'Assign Permission');
$this->params['breadcrumbs'] = [
    ['label' => Yii::t('app', 'Role'), 'url' =>  Url::previous('BackendDynamic-' . Yii::$app->controller->id)],
    ['label' => $this->title],
];
$otherAuths = AuthItem::loadOtherAuth();

?>
<style type="text/css">
    .col-sm-1 {
        padding-right: 0px !important;
    }
    .col-sm-1 input, label {
        cursor: pointer !important;
    }
    .col-sm-11 input, label {
        padding-left: 0px !important;
    }
    .col-sm-11 {
        cursor: pointer !important;        
    }
</style>
 <div class="row">
    <div class="col-sm-12">
        <div class="ibox">
            <?= $this->render('/widgets/_ibox-title') ?>
            <div class="ibox-content"> 
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
				<?php if ($menuData): ?>
					<?php foreach ($menuData as $key => $data): ?>
				    <div class="form-group">
						<div class="col-sm-1 text-left">
                            <input type="checkbox"  value="<?= $data['id'] ?>"  id="menuList_<?= $data['id'] ?>_<?= Yii::$app->controller->_uniqid ?>"class="chooseAll" data-pid="<?= $data['parent_id'] ?>" data-url="<?= $data['url'] ?>">
                            <label for="menuList_<?= $data['id'] ?>_<?= Yii::$app->controller->_uniqid ?>"><?= $data['name'] ?></label>
                        </div>
                        <?php if (isset($data['children']) && !empty($data['children'])): ?>
                        	<div class="col-sm-11">
	                            <?php foreach ($data['children'] as $key2 => $value2): ?>
                                    <div class="col-sm-1 text-left">
                                        <input type="checkbox"  value="<?= $value2['id'] ?>" id="menuList_<?= $value2['id'] ?>_<?= Yii::$app->controller->_uniqid ?>" data-pid="<?= $value2['parent_id'] ?>" data-url="<?= $value2['url'] ?>">
                                        <label for="menuList_<?= $value2['id'] ?>_<?= Yii::$app->controller->_uniqid ?>"><?= $value2['name'] ?></label>  
                                    </div>
                                    <?php if ($value2['roles']): ?>
                                        <div class="col-sm-11">
                                            <?php foreach ($value2['roles'] as $role): ?>
                                                <div style="display: inline;padding-left: 20px;" title="<?= $role->rule_name ?>">
                                                    <input type="checkbox"  value="<?= $role->id ?>" id="roleList_<?= $role->id ?>_<?= Yii::$app->controller->_uniqid ?>" data-menuid="<?= $role->menu_id ?>" data-rule="<?= $role->rule_format ?>">
                                                    <label for="roleList_<?= $role->id ?>_<?= Yii::$app->controller->_uniqid ?>"  style="color:#ec7063"><?= $role->description ?></label>                                           
                                                </div>
                                              <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
	                              <?php endforeach; ?>
							</div>
	                    <?php elseif ($data['roles']): ?>
                        	<div class="col-sm-11">
	                            <?php foreach ($data['roles'] as $role): ?>
									<div style="display: inline;padding-left: 20px;" title="<?= $role->rule_name ?>">
										<input type="checkbox"  value="<?= $role->id ?>" id="roleList_<?= $role->id ?>_<?= Yii::$app->controller->_uniqid ?>" data-menuid="<?= $role->menu_id ?>" data-rule="<?= $role->rule_format ?>">
										<label for="roleList_<?= $role->id ?>_<?= Yii::$app->controller->_uniqid ?>"  style="color:#ec7063"><?= $role->description ?></label>	                            			
									</div>
	                              <?php endforeach; ?>
							</div>
                    	<?php endif; ?>
                    </div>
					<?php endforeach; ?>
				<?php endif; ?> 
                <div class="form-group">
                    <div class="col-sm-1 text-left">
                        <input type="checkbox"  value="other"  id="menuList_other_<?= Yii::$app->controller->_uniqid ?>" class="chooseAll">
                        <label for="menuList_other_<?= Yii::$app->controller->_uniqid ?>"><?= Yii::t('app', 'Other') ?></label>
                    </div>                    
                    <?php if ($otherAuths): ?>
                        <div class="col-sm-11">
                            <?php foreach ($otherAuths as $role): ?>
                                <div style="display: inline;padding-left: 20px;" title="<?= $role->rule_name ?>">
                                    <input type="checkbox"  value="<?= $role->id ?>" id="roleList_<?= $role->id ?>_<?= Yii::$app->controller->_uniqid ?>" data-menuid="<?= $role->menu_id ?>" data-rule="<?= $role->rule_format ?>">
                                    <label for="roleList_<?= $role->id ?>_<?= Yii::$app->controller->_uniqid ?>"  style="color:#ec7063"><?= $role->description ?></label>                                           
                                </div>                              
                            <?php endforeach ?>
                        </div>  
                    <?php endif; ?>    
                </div>  
                <div class="alert alert-info">
                    <div style="float:left;background-color:#ec7063;width:16px;height:16px;border-radius: 16px;"></div>
                    <span style="padding-left: 10px"><?= Yii::t('app', 'Representation of permissions') ?></span>
                </div>
				<div class="clearfix hr-line-dashed"></div>
				<?php if ($model->id != AdminRoles::SUPER_ROLE_ID): ?>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2  text-right">
                        <?= Html::SubmitButton(Yii::t('app', 'Assign Permission'), ['class' => 'btn btn-success']) ?>                                       
                    </div>
                </div>   
            	<?php endif; ?>
                <?php ActiveForm::end(); ?>  
            </div>      
        </div>
    </div>
</div>