<?php 

namespace common\components;

use yii;
use yii\base\InvalidParamException;

/**
* 基础数据配置类
* @author atuxe <atuxe@boyuntong.com>
*/
class BaseConfig
{
    const YesNo_Yes = 1;
    const YesNo_No = 0;

    const PUBLISH_YES = 1;
    const PUBLISH_NO = 0;

    const Status_Enable = 1;
    const Status_Desable = 0;

    const COMMENT_INITIAL = 0;
    const COMMENT_PUBLISH = 1;
    const COMMENT_RUBISSH = 2;

    const TARGET_BLANK = '_blank';
    const TARGET_SELF = '_self';

    const HTTP_METHOD_ALL = 0;
    const HTTP_METHOD_GET = 1;
    const HTTP_METHOD_POST = 2;

    const INPUT_INPUT = 1;
    const INPUT_TEXTAREA = 2;
    const INPUT_UEDITOR = 3;

    const ARTICLE_VISIBILITY_PUBLIC = 1;
    const ARTICLE_VISIBILITY_COMMENT = 2;
    const ARTICLE_VISIBILITY_SECRET = 3;

    const LANGUAGE_ZN_CN = 'zh_CN';
    // const LANGUAGE_ZN_TW = 'ZN_TW';
    const LANGUAGE_EN_US = 'en-US'; 

    const WEB_TEMPLATE_ONE = 'template1';

    public static function getYesNoItems($key = null)
    {
        $items = [
            self::YesNo_Yes => Yii::t('app', 'Yes'),
            self::YesNo_No => Yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }

	public static function statusOption()
	{
		return ['1'=>'激活', '2'=>'锁定',];
	}

    public static function getWebsiteStatusItems($key = null)
    {
        $items = [
            self::YesNo_Yes => Yii::t('app', 'Opened'),
            self::YesNo_No => Yii::t('app', 'Closed'),
        ];
        return self::getItems($items, $key);
    }

    public static function getCommentStatusItems($key = null)
    {
        $items = [
            self::COMMENT_INITIAL => Yii::t('app', 'Not Audited'),
            self::COMMENT_PUBLISH => Yii::t('app', 'Passed'),
            self::COMMENT_RUBISSH => Yii::t('app', 'Unpassed'),
        ];
        return self::getItems($items, $key);
    }

    public static function getTargetOpenMethod($key = null)
    {
        $items = [
            self::TARGET_BLANK => Yii::t('app', 'Yes'),
            self::TARGET_SELF => Yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }

    public static function getHttpMethodItems($key = null)
    {
        $items = [
            self::HTTP_METHOD_ALL => 'all',
            self::HTTP_METHOD_GET => 'get',
            self::HTTP_METHOD_POST => 'post',
        ];
        return self::getItems($items, $key);
    }

    public static function getArticleStatus($key = null)
    {
        $items = [
            self::PUBLISH_YES => Yii::t('app', 'Publish'),
            self::PUBLISH_NO => Yii::t('app', 'Draft'),
        ];
        return self::getItems($items, $key);
    }

    public static function getInputTypeItems($key = null)
    {
        $items = [
            self::INPUT_INPUT => 'input',
            self::INPUT_TEXTAREA => 'textarea',
            self::INPUT_UEDITOR => 'ueditor',
        ];
        return self::getItems($items, $key);
    }

    public static function getArticleVisibility($key = null)
    {
        $items = [
            self::ARTICLE_VISIBILITY_PUBLIC => Yii::t('app', 'Public'),
            self::ARTICLE_VISIBILITY_COMMENT => Yii::t('app', 'Reply'),
            self::ARTICLE_VISIBILITY_SECRET => Yii::t('app', 'Password'),
        ];
        return self::getItems($items, $key);
    }

    public static function getStatusItems($key = null)
    {
        $items = [
            self::Status_Enable => Yii::t('app', 'Enable'),
            self::Status_Desable => Yii::t('app', 'Disable'),
        ];
        return self::getItems($items, $key);
    }

    private static function getItems($items, $key = null)
    {
        if ($key !== null) {
            if (key_exists($key, $items)) {
                return $items[$key];
            }
            throw new InvalidParamException( 'Unknown key:' . $key );
        }
        return $items;
    }

    public static function getLanguageItems($key = null)
    {
        $items = [
            self::LANGUAGE_ZN_CN => '简体中文',
            self::LANGUAGE_EN_US => 'English',
        ];

        return self::getItems($items, $key);
    }

    public static function getWebTemplateItems($key = null) 
    {
        $items = [
            self::WEB_TEMPLATE_ONE => '模板一',
        ];

        return self::getItems($items, $key);        
    }
}
