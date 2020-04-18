<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\helpers;

use Yii;
use yii\helpers\Html AS CommonHtml;

/**
 * Class Html
 * @package backend\helpers
 */
class Html extends CommonHtml
{
    /**
     * @param $name
     * @param null $selection
     * @param array $items
     * @param array $options
     * @param array $imgSrc
     * @return string
     */
    public static function imagePicker($name, $selection = null, $items = [], $options = [], $imgSrc = [])
    {
        $options = array_merge($options, ['class' => 'form-control image-picker', 'options' => $imgSrc]);

        return parent::dropDownList($name, $selection, $items, $options);
    }

    /**
     * @param $name
     * @param null $select
     * @param $items
     * @param array $options
     * @param bool $generateDefault
     * @return string
     */
    public static function chosenSelect($name, $select = null, $items, $options = [], $generateDefault = true)
    {
        if (!empty($options['class']))
            $options['class'] .= " chosen-select";
        else
            $options['class'] = "chosen-select";
        !isset($options['multiple']) && $options['multiple'] = '1';
        !isset($options['allow_single_deselect']) && $options['allow_single_deselect'] = true;
        $options['allow_single_deselect'] === true && $options['allow_single_deselect'] = 'true';
        $options['allow_single_deselect'] === false && $options['allow_single_deselect'] = 'false';
        !isset($options['disable_search']) && $options['disable_search'] = false;
        $options['disable_search'] === true && $options['disable_search'] = 'true';
        $options['disable_search'] === false && $options['disable_search'] = 'false';
        !isset($options['disable_search_threshold']) && $options['disable_search_threshold'] = 0;
        !isset($options['enable_split_word_search']) && $options['enable_split_word_search'] = true;
        $options['enable_split_word_search'] === true && $options['enable_split_word_search'] = 'true';
        $options['enable_split_word_search'] === false && $options['enable_split_word_search'] = 'false';
        !isset($options['inherit_select_classes']) && $options['inherit_select_classes'] = false;
        $options['inherit_select_classes'] === true && $options['inherit_select_classes'] = 'true';
        $options['inherit_select_classes'] === false && $options['inherit_select_classes'] = 'false';
        !isset($options['max_selected_options']) && $options['max_selected_options'] = 'Infinity';
        !isset($options['no_results_text']) && $options['no_results_text'] = Yii::t('app', 'None');
        !isset($options['placeholder_text_multiple']) && $options['placeholder_text_multiple'] = Yii::t('app', 'Please select some');;
        !isset($options['placeholder_text_single']) && $options['placeholder_text_single'] = Yii::t('app', 'Please select');
        !isset($options['search_contains']) && $options['search_contains'] = true;
        $options['search_contains'] === true && $options['search_contains'] = 'true';
        $options['search_contains'] === false && $options['search_contains'] = 'false';
        !isset($options['group_search']) && $options['group_search'] = true;
        $options['group_search'] === true && $options['group_search'] = 'true';
        $options['group_search'] === false && $options['group_search'] = 'false';
        !isset($options['single_backstroke_delete']) && $options['single_backstroke_delete'] = true;
        $options['single_backstroke_delete'] === true && $options['single_backstroke_delete'] = 'true';
        $options['single_backstroke_delete'] === false && $options['single_backstroke_delete'] = 'false';
        !isset($options['width']) && $options['width'] = '100%';
        !isset($options['display_disabled_options']) && $options['display_disabled_options'] = true;
        $options['display_disabled_options'] === true && $options['display_disabled_options'] = 'true';
        $options['display_disabled_options'] === false && $options['display_disabled_options'] = 'false';
        !isset($options['display_selected_options']) && $options['display_selected_options'] = true;
        $options['display_selected_options'] === true && $options['display_selected_options'] = 'true';
        $options['display_selected_options'] === false && $options['display_selected_options'] = 'false';
        !isset($options['include_group_label_in_selected']) && $options['include_group_label_in_selected'] = false;
        $options['include_group_label_in_selected'] === true && $options['include_group_label_in_selected'] = 'true';
        $options['include_group_label_in_selected'] === false && $options['include_group_label_in_selected'] = 'false';
        !isset($options['max_shown_results']) && $options['max_shown_results'] = 'Infinity';
        !isset($options['case_sensitive_search']) && $options['case_sensitive_search'] = false;
        $options['case_sensitive_search'] === true && $options['case_sensitive_search'] = 'true';
        $options['case_sensitive_search'] === false && $options['case_sensitive_search'] = 'false';
        !isset($options['hide_results_on_select']) && $options['hide_results_on_select'] = true;
        $options['hide_results_on_select'] === true && $options['hide_results_on_select'] = 'true';
        $options['hide_results_on_select'] === false && $options['hide_results_on_select'] = 'false';
        !isset($options['rtl']) && $options['trl'] = false;
        $options['trl'] === true && $options['trl'] = 'true';
        $options['trl'] === false && $options['trl'] = 'false';
        if ($generateDefault === true && !isset($options['prompt'])) {
            $options['prompt'] = Yii::t('app', 'Please select');
        }
        return self::dropDownList($name, $select, $items, $options);
    }
}
