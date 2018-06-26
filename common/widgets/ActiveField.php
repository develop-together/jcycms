<?php 
/**
 * @author: yjc
 * @email: 2064320087@qq.com
 * Created at: 2018-06-25 22:47
 */

namespace common\widgets;

use Yii; 
use yii\helpers\Html;
use yii\helpers\Json;

class ActiveField extends \yii\widgets\ActiveField
{
	
	public $options = ['class' => 'form-group'];

	// public $labelOptions = ['class' => 'col-sm-2 control-label];
	
	public $size = 10;

	// public $template = "{label}\n<div class=\"col-sm-{size}\">{input}\n{error}</div>\n{hint}";

    // public $errorOptions = ['class' => 'help-block m-b-none'];
    
    public function init()
    {
    	parent::init();
		if (method_exists($this->model, 'autoCompleteOptions')) {
			$autoCompleteOptions = $this->model->autoCompleteOptions();
			if (isset($autoCompleteOptions[$this->attribute])) {
				if (is_callable($autoCompleteOptions[$this->attribute])) {
					$this->autoComplete(call_user_func($autoCompleteOptions[$this->attribute]));
				} else {
					$this->autoComplete($autoCompleteOptions[$this->attribute]);
				}
			}
		}
    }

    /**
     * autoComplete
     * options 插件参数: 
     * 	@param data:数据源--同步请求直接传递数据源
     *	@param url:异步请求数据来源的地址（*json）
     *	@param isCache: 是否缓存 true使用prefetch[url为静态json文件] false使用remote
     *	@param selectedByField: 选中后赋值的字段，该字段参与表单提交
     *  @param selectedDomId:用于赋值
     *	@param name: 数据集的名称
     *	@param displayKey: 列表展示的字段
     *	@param valueKey: 选中赋值到selectedByField的key
     *  @param limit 显示条数    
     * @author yjc
     */
    public function autoComplete($options)
    {
    	static $counter = 0;
    	$this->inputOptions['class'] .= ' typeahead typeahead-' . (++$counter);
    	!isset($options['data']) && $options['data'] = null;
    	!isset($options['url']) && $options['url'] = '';
    	!isset($options['limit']) && $options['limit'] = 5;
    	!isset($options['isCache']) && $options['isCache'] = false;
    	if (isset($options['selectedByField']) && !empty($options['selectedByField'])) {
    		$field = $this->form->field($this->model, $options['selectedByField']);
    		$field->options['class'] .= ' hide';
    		$field->inputOptions['id'] = $options['selectedDomId'];
    		echo $field->hiddenInput()->label(false);
    	}

        $this->form->getView()->registerJs("jcms.autocomplete($counter, " . Json::htmlEncode($options) . ");");
        return $this;
    }
}